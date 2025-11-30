# Code Analysis - Kampay Ticket System

This document explains how the codebase works, step-by-step, to help developers understand the implementation.

---

## Architecture Overview

The application follows **MVC (Model-View-Controller)** architecture with Laravel:

- **Models**: Database interactions (Eloquent ORM)
- **Controllers**: Handle HTTP requests and business logic
- **Views**: Blade templates for UI
- **Services**: External API integrations (Supabase)

---

## Database Architecture: Hybrid Approach

### **Why Hybrid?**

The system uses:
- **MySQL**: All relational data (users, tickets, suggestions, announcements)
- **Supabase Storage**: File uploads only (images, PDFs, documents)

**Reason**: MySQL handles structured data efficiently, while Supabase Storage provides scalable cloud file storage.

---

## Step-by-Step: How It Works

### 1. **User Registration Flow**

**File**: `app/Http/Controllers/Auth/RegisterController.php`

```php
// Step 1: Validate user input
$validated = $request->validate([...]);

// Step 2: Generate UUID for user
$userId = (string) Str::uuid();

// Step 3: Create user in database
$user = User::create([...]);

// Step 4: Create profile with same UUID (one-to-one relationship)
$profile = Profile::create([
    'id' => $userId,  // Same UUID links user and profile
    'role' => $request->role,
    'name' => $request->name,
]);
```

**Key Concept**: User and Profile share the same UUID, creating a one-to-one relationship enforced at the database level.

---

### 2. **Authentication & Session Management**

**File**: `app/Http/Controllers/Auth/LoginController.php`

```php
// Step 1: Validate credentials
$credentials = $request->validate([...]);

// Step 2: Attempt login
if (Auth::attempt($credentials)) {
    // Step 3: Get user's profile to determine role
    $profile = Profile::find($user->id);
    $role = $profile->role;
    
    // Step 4: Store user data in session
    session()->put('user', [
        'id' => $user->id,
        'name' => $user->name,
        'role' => $role,
    ]);
    
    // Step 5: Redirect based on role
    if ($role === 'employee') {
        return redirect()->route('staff.dashboard');
    }
    return redirect()->route('reports.index');
}
```

**Key Concept**: 
- Laravel's `Auth::attempt()` handles password verification
- Session stores user data for quick access in views
- Role-based redirection after login

---

### 3. **Ticket/Report Creation Flow**

**File**: `app/Http/Controllers/TicketController.php`

```php
public function store(Request $request)
{
    // Step 1: Validate input
    $validated = $request->validate([
        'subject' => 'required',
        'description' => 'nullable',
        'priority' => 'required|in:low,medium,high,urgent',
        'attachments' => 'nullable|array',
    ]);
    
    // Step 2: Get authenticated user's profile
    $user = auth()->user();
    $profile = $user->profile;
    
    // Step 3: Create ticket in database
    $ticket = Ticket::create([
        'id' => Str::uuid(),
        'customer_id' => $profile->id,
        'subject' => $validated['subject'],
        'status' => 'open',
        'priority' => $validated['priority'],
    ]);
    
    // Step 4: Handle file uploads (if any)
    if ($request->hasFile('attachments')) {
        foreach ($request->file('attachments') as $file) {
            // Upload to Supabase Storage
            $upload = $this->supabase->uploadFile($file, "tickets/{$ticket->id}");
            
            // Save file metadata to database
            $ticket->attachments()->create([
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $upload['path'],
                'file_url' => $upload['url'],
                'file_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
            ]);
        }
    }
}
```

**Key Concepts**:
- **Mass Assignment**: Using `fillable` array in models for security
- **UUID Generation**: Using `Str::uuid()` for unique IDs
- **File Upload**: Two-step process (upload file, save metadata)
- **Relationship**: `$ticket->attachments()->create()` uses Eloquent relationship

---

### 4. **Model Relationships (Eloquent)**

**File**: `app/Models/Ticket.php`

```php
// One-to-Many: One ticket has many messages
public function messages()
{
    return $this->hasMany(Message::class);
}

// Many-to-One: Many tickets belong to one customer
public function customer()
{
    return $this->belongsTo(Profile::class, 'customer_id');
}

// Many-to-One: Many tickets can be assigned to one employee
public function assignedEmployee()
{
    return $this->belongsTo(Profile::class, 'assigned_employee_id');
}
```

**Usage in Controller**:
```php
// Eager loading prevents N+1 query problem
$tickets = Ticket::with(['customer', 'assignedEmployee', 'messages'])
    ->latest()
    ->paginate(15);
```

**Key Concept**: 
- **Eager Loading**: `with()` loads relationships in one query instead of multiple
- **N+1 Problem**: Without eager loading, loading 10 tickets would execute 11 queries (1 for tickets + 10 for relationships)

---

### 5. **Role-Based Access Control**

**File**: `app/Models/Profile.php`

```php
public function isEmployee()
{
    return in_array($this->role, ['employee', 'admin']);
}

public function isCitizen()
{
    return $this->role === 'citizen' || $this->role === 'customer';
}
```

**Usage in Controller**:
```php
// Check if user can view all tickets or only their own
if ($profile->isEmployee()) {
    // Staff sees all tickets
    $tickets = Ticket::with(['customer', 'assignedEmployee'])->latest()->paginate(15);
} else {
    // Citizens see only their tickets
    $tickets = Ticket::where('customer_id', $profile->id)->latest()->paginate(15);
}
```

**Key Concept**: Helper methods in models make code more readable and reusable.

---

### 6. **File Upload Service (Supabase)**

**File**: `app/Services/SupabaseService.php`

```php
public function uploadFile(UploadedFile $file, string $path): array
{
    // Step 1: Check if Supabase is configured
    if (!$this->isConfigured()) {
        throw new Exception('Supabase not configured');
    }
    
    // Step 2: Sanitize filename
    $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
    $filePath = trim($path . '/' . $fileName, '/');
    
    // Step 3: Upload to Supabase Storage API
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $this->serviceKey,
        'Content-Type' => $file->getMimeType(),
    ])->put("{$this->url}/storage/v1/object/{$bucket}/{$filePath}", 
        file_get_contents($file->getRealPath())
    );
    
    // Step 4: Return file info
    return [
        'path' => $filePath,
        'url' => $this->getPublicUrl($bucket, $filePath),
    ];
}
```

**Key Concepts**:
- **Service Class**: Separates external API logic from controllers
- **Dependency Injection**: Controllers receive service via constructor
- **Fallback**: If Supabase not configured, falls back to local storage

---

### 7. **Migration from Supabase to MySQL**

**Before**: Suggestions and Announcements stored in Supabase REST API
**After**: All data stored in MySQL using Eloquent

**How it was done**:

1. **Created Migrations**: New tables for `suggestions`, `suggestion_comments`, `announcements`
2. **Created Models**: Eloquent models with relationships
3. **Updated Controllers**: Replaced SupabaseService calls with Eloquent queries

**Example Transformation**:

**Before (Supabase)**:
```php
$suggestions = $this->supabase->select('suggestions', [], 'suggest_id,title,category', 'created_at', 'desc');
```

**After (Eloquent)**:
```php
$suggestions = Suggestion::with(['author', 'comments'])
    ->latest()
    ->get()
    ->map(function($suggestion) {
        return [
            'id' => $suggestion->id,
            'title' => $suggestion->title,
            'author' => $suggestion->author ? $suggestion->author->name : 'Anonymous',
            'comments' => $suggestion->comments->count(),
        ];
    });
```

**Benefits**:
- Better performance (local queries vs API calls)
- Easier relationships (Eloquent handles joins)
- Type safety (IDE autocomplete)
- Database transactions support

---

### 8. **Route Structure & Middleware**

**File**: `routes/web.php`

```php
// Public routes (no authentication required)
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/suggestions', [SuggestionController::class, 'index']);

// Protected routes (require authentication)
Route::middleware('auth')->group(function () {
    Route::get('/reports', [TicketController::class, 'index']);
    Route::post('/reports', [TicketController::class, 'store']);
});

// Route model binding (automatic model resolution)
Route::get('/reports/{ticket}', [TicketController::class, 'show']);
// Laravel automatically finds Ticket model by ID
```

**Key Concepts**:
- **Middleware**: `auth` middleware checks if user is logged in
- **Route Model Binding**: `{ticket}` automatically resolves to `Ticket` model
- **Route Groups**: Organize routes with shared middleware

---

### 9. **Pagination**

**Example**: `TicketController::index()`

```php
$tickets = Ticket::with(['customer', 'assignedEmployee'])
    ->latest()
    ->paginate(15);

// In view:
{{ $tickets->links() }}  // Renders pagination links
```

**How it works**:
1. `paginate(15)` limits results to 15 per page
2. Automatically calculates total pages
3. Provides `links()` method for navigation
4. Handles `?page=2` query parameter

---

### 10. **Form Validation**

**Example**: `TicketController::store()`

```php
$validated = $request->validate([
    'subject' => ['required', 'string', 'max:255'],
    'priority' => ['required', 'in:low,medium,high,urgent'],
    'attachments.*' => ['file', 'max:10240', 'mimes:jpeg,jpg,png,pdf'],
], [
    'attachments.*.max' => 'Each attachment must not be larger than 10MB.',
]);
```

**How it works**:
1. Laravel validates input against rules
2. If validation fails, redirects back with errors
3. `attachments.*` validates each file in array
4. Custom error messages can be provided

---

### 11. **Access Control in Controllers**

**Example**: `SuggestionController::edit()`

```php
public function edit($id)
{
    // Check if user is staff
    if (!session('user') || !in_array(session('user')['role'], ['employee', 'admin'])) {
        abort(403, 'Only staff members can edit suggestions.');
    }
    
    $suggestion = Suggestion::findOrFail($id);
    return view('suggestions.edit', compact('suggestion'));
}
```

**Key Concepts**:
- **Authorization**: Check user role before allowing action
- **abort(403)**: Returns 403 Forbidden error
- **findOrFail()**: Throws 404 if model not found

---

### 12. **Database Transactions**

**Example**: `RegisterController::register()`

```php
DB::beginTransaction();
try {
    $user = User::create([...]);
    $profile = Profile::create([...]);
    DB::commit();
} catch (\Exception $e) {
    DB::rollBack();
    return back()->withErrors(['email' => 'Registration failed.']);
}
```

**Why use transactions?**
- Ensures both user and profile are created together
- If one fails, both are rolled back
- Prevents orphaned records

---

## Key Design Patterns Used

### 1. **Repository Pattern** (Partial)
- Models handle database queries
- Controllers use models, not raw queries

### 2. **Service Layer Pattern**
- `SupabaseService` handles external API
- Separates concerns from controllers

### 3. **Dependency Injection**
```php
public function __construct(SupabaseService $supabase)
{
    $this->supabase = $supabase;
}
```
- Laravel automatically injects service
- Makes testing easier (can mock services)

### 4. **Active Record Pattern**
- Eloquent models represent database tables
- Models have methods for relationships

---

## Data Flow Examples

### **Creating a Ticket with Attachments**:

```
1. User submits form → TicketController::store()
2. Validate input → Laravel validation
3. Create ticket → Ticket::create() → MySQL
4. Upload files → SupabaseService::uploadFile() → Supabase Storage
5. Save metadata → Attachment::create() → MySQL
6. Redirect → View ticket page
```

### **Viewing Tickets**:

```
1. User visits /reports → TicketController::index()
2. Check role → Profile::isEmployee()
3. Query tickets → Ticket::with(['customer'])->paginate()
4. Eager load relationships → Single query with joins
5. Return view → Blade template renders data
```

---

## Important Code Patterns

### **UUID Usage**
```php
'id' => (string) Str::uuid()
```
- All primary keys use UUIDs
- Prevents enumeration attacks
- Better for distributed systems

### **Mass Assignment Protection**
```php
protected $fillable = ['title', 'description', 'status'];
```
- Only specified fields can be mass-assigned
- Prevents malicious input

### **Accessor Methods**
```php
public function getStatusColorAttribute()
{
    return match($this->status) {
        'open' => 'kampay-teal',
        'in_progress' => 'kampay-yellow-orange',
        // ...
    };
}
// Usage: $ticket->status_color
```
- Computed properties on models
- Keeps view logic out of templates

---

## Summary

**Architecture**: MVC with Service Layer
**Database**: MySQL for data, Supabase for files
**ORM**: Eloquent (Active Record pattern)
**Authentication**: Laravel Auth with session storage
**File Storage**: Supabase Storage API with local fallback
**Key Features**: Role-based access, UUIDs, Eager loading, Transactions

This codebase demonstrates:
- Clean separation of concerns
- Proper use of Laravel features
- Security best practices
- Scalable architecture

