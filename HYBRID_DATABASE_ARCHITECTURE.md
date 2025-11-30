# Hybrid Database Architecture - Implementation Plan

## 📊 System Architecture Overview

### Database Distribution

| Module | Database | Reason | CRUD Status |
|--------|----------|--------|-------------|
| **Authentication** | Supabase | Modern auth system, JWT tokens | ✅ Full CRUD |
| **Users & Profiles** | Supabase | Linked to auth, single source of truth | ✅ Full CRUD |
| **Reports/Tickets** | Supabase | Already using Supabase, consistent | ✅ Full CRUD |
| **Suggestions** | Supabase | Already implemented | ✅ Full CRUD |
| **Announcements** | MySQL | Demonstrates MySQL CRUD for grading | ✅ Full CRUD |

---

## 🔐 Authentication Flow (Supabase Auth + localStorage)

### Current vs Proposed

| Aspect | Current (Laravel Auth) | Proposed (Supabase Auth) |
|--------|----------------------|-------------------------|
| **Auth Provider** | Laravel Session | Supabase Auth |
| **User Storage** | MySQL `users` table | Supabase `auth.users` table |
| **Session Storage** | PHP Session | localStorage (JWT tokens) |
| **Profile Storage** | MySQL `profiles` table | Supabase `profiles` table |
| **Login Method** | `Auth::attempt()` | `supabase.auth.signInWithPassword()` |
| **Logout Method** | `Auth::logout()` | `supabase.auth.signOut()` |
| **Middleware** | `auth` middleware | Custom middleware checking localStorage |

---

## 🏗️ Complete Architecture Diagram

```
┌─────────────────────────────────────────────────────────────┐
│                    CLIENT (Browser)                          │
│  ┌──────────────────────────────────────────────────────┐   │
│  │  localStorage:                                        │   │
│  │  - access_token (JWT from Supabase)                  │   │
│  │  - refresh_token                                      │   │
│  │  - user_data { id, email, name, role }               │   │
│  └──────────────────────────────────────────────────────┘   │
└─────────────────────────────────────────────────────────────┘
                            │
                            │ HTTP Requests
                            │ (with JWT in headers)
                            ▼
┌─────────────────────────────────────────────────────────────┐
│              LARAVEL APPLICATION (Backend)                   │
│                                                               │
│  ┌──────────────────────────────────────────────────────┐   │
│  │  Middleware: Check JWT from localStorage              │   │
│  │  - Validate token with Supabase                       │   │
│  │  - Set user in session/request                        │   │
│  └──────────────────────────────────────────────────────┘   │
│                                                               │
│  ┌──────────────────┐         ┌──────────────────┐         │
│  │  Controllers      │         │  Services         │         │
│  │  - AuthController │────────▶│  - SupabaseService│         │
│  │  - TicketController│        │  - MySQLService   │         │
│  │  - Announcement   │         │                   │         │
│  └──────────────────┘         └──────────────────┘         │
└─────────────────────────────────────────────────────────────┘
                            │
            ┌───────────────┴───────────────┐
            │                               │
            ▼                               ▼
┌──────────────────────┐      ┌──────────────────────┐
│   SUPABASE DATABASE  │      │    MYSQL DATABASE     │
│                      │      │                      │
│  📦 auth.users       │      │  📦 announcements    │
│     - id (UUID)      │      │     - id             │
│     - email          │      │     - title          │
│     - password_hash  │      │     - content        │
│                      │      │     - category       │
│  📦 profiles         │      │     - created_at     │
│     - id (FK)        │      │     - updated_at     │
│     - role           │      │                      │
│     - name           │      │                      │
│                      │      │                      │
│  📦 tickets          │      │                      │
│     - id             │      │                      │
│     - customer_id    │      │                      │
│     - subject        │      │                      │
│     - status         │      │                      │
│                      │      │                      │
│  📦 messages         │      │                      │
│     - ticket_id      │      │                      │
│     - sender_id      │      │                      │
│                      │      │                      │
│  📦 suggestions      │      │                      │
│     - suggest_id     │      │                      │
│     - posted_by      │      │                      │
└──────────────────────┘      └──────────────────────┘
```

---

## 🔄 Authentication Flow Details

### Login Process

| Step | Action | Location | Data Flow |
|------|--------|----------|-----------|
| 1 | User enters email/password | Frontend Form | `email`, `password` |
| 2 | JavaScript calls Supabase Auth | `resources/js/auth.js` | `supabase.auth.signInWithPassword()` |
| 3 | Supabase validates credentials | Supabase Server | Returns JWT tokens |
| 4 | Store tokens in localStorage | Browser | `access_token`, `refresh_token` |
| 5 | Store user data in localStorage | Browser | `user_data: { id, email, name, role }` |
| 6 | Redirect to dashboard | Frontend | Check role, redirect accordingly |

### Request Flow (After Login)

| Step | Component | Action | Purpose |
|------|-----------|--------|---------|
| 1 | JavaScript | Read token from localStorage | Get authentication token |
| 2 | Axios/Fetch | Add token to request header | `Authorization: Bearer {token}` |
| 3 | Laravel Middleware | Validate token with Supabase | Verify user is authenticated |
| 4 | Controller | Access user data | Get user info from Supabase |
| 5 | Controller | Process request | Execute business logic |
| 6 | Response | Return data | Send result to frontend |

### Logout Process

| Step | Action | Location | Result |
|------|--------|----------|--------|
| 1 | User clicks logout | Frontend | Trigger logout |
| 2 | Call Supabase signOut | JavaScript | `supabase.auth.signOut()` |
| 3 | Clear localStorage | JavaScript | Remove all auth data |
| 4 | Redirect to home | Frontend | User logged out |

---

## 📋 Implementation Checklist

### Phase 1: Supabase Auth Setup

- [ ] Install Supabase JavaScript client
  ```bash
  npm install @supabase/supabase-js
  ```
- [ ] Create Supabase client configuration
  - File: `resources/js/supabase-client.js`
  - Initialize Supabase client with URL and anon key
- [ ] Update login form
  - File: `resources/views/auth/login.blade.php`
  - Remove Laravel form, add JavaScript handler
- [ ] Update register form
  - File: `resources/views/auth/register.blade.php`
  - Use Supabase Auth signup
- [ ] Create auth JavaScript module
  - File: `resources/js/auth.js`
  - Functions: login, register, logout, checkAuth

### Phase 2: Middleware & Backend

- [ ] Create custom auth middleware
  - File: `app/Http/Middleware/VerifySupabaseToken.php`
  - Validate JWT token from request header
- [ ] Update routes to use new middleware
  - File: `routes/web.php`
  - Replace `auth` middleware with custom middleware
- [ ] Update controllers to get user from Supabase
  - Remove `auth()->user()`
  - Get user from Supabase using token

### Phase 3: Move Announcements to MySQL

- [ ] Create Announcement model
  - File: `app/Models/Announcement.php`
  - Use Eloquent ORM
- [ ] Create migration
  - File: `database/migrations/xxxx_create_announcements_table.php`
  - Define MySQL table structure
- [ ] Update AnnouncementController
  - Replace SupabaseService calls with Eloquent
  - Use `Announcement::create()`, `Announcement::find()`, etc.
- [ ] Test CRUD operations
  - Create, Read, Update, Delete announcements

### Phase 4: Move Reports to Supabase

- [ ] Create tables in Supabase
  - `tickets` table
  - `messages` table
  - `attachments` table
- [ ] Update TicketController
  - Replace Eloquent with SupabaseService
  - Use `$this->supabase->insert()`, `$this->supabase->select()`, etc.
- [ ] Update MessageController
  - Use SupabaseService for messages
- [ ] Update user references
  - Store user IDs as UUID strings
  - Fetch user names from Supabase profiles

### Phase 5: Data Synchronization

- [ ] Create helper service
  - File: `app/Services/UserService.php`
  - Methods to fetch user data from Supabase
- [ ] Update views
  - Display user names from Supabase
  - Handle user data in all views

---

## 💾 localStorage Structure

### Data Stored in localStorage

| Key | Type | Content | Example |
|-----|------|---------|---------|
| `supabase.auth.token` | String | Access token (JWT) | `eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...` |
| `supabase.auth.refresh_token` | String | Refresh token | `refresh_token_string` |
| `user_data` | Object | User information | `{ id: "uuid", email: "user@email.com", name: "John", role: "citizen" }` |
| `user_profile` | Object | Profile data | `{ id: "uuid", role: "citizen", name: "John Doe" }` |

### localStorage Management

```javascript
// Save after login
localStorage.setItem('supabase.auth.token', accessToken);
localStorage.setItem('user_data', JSON.stringify(userData));

// Read in requests
const token = localStorage.getItem('supabase.auth.token');
const userData = JSON.parse(localStorage.getItem('user_data'));

// Clear on logout
localStorage.removeItem('supabase.auth.token');
localStorage.removeItem('user_data');
```

---

## 🔗 Cross-Database Relationships

### How User IDs Connect Systems

| Relationship | Source | Target | Method |
|--------------|--------|--------|--------|
| Ticket → User | Supabase `tickets.customer_id` | Supabase `profiles.id` | Direct query in Supabase |
| Suggestion → User | Supabase `suggestions.posted_by` | Supabase `profiles.id` | Direct query in Supabase |
| Announcement → User | MySQL `announcements.posted_by` | Supabase `profiles.id` | Fetch from Supabase in PHP |
| Message → User | Supabase `messages.sender_id` | Supabase `profiles.id` | Direct query in Supabase |

### Data Fetching Pattern

```
┌─────────────────────────────────────────────────┐
│  Display Ticket with User Name                  │
└─────────────────────────────────────────────────┘
                    │
                    ▼
        ┌───────────────────────┐
        │  Fetch Ticket         │
        │  (from Supabase)      │
        └───────────────────────┘
                    │
                    ▼
        ┌───────────────────────┐
        │  Extract customer_id  │
        │  (UUID string)        │
        └───────────────────────┘
                    │
                    ▼
        ┌───────────────────────┐
        │  Fetch Profile        │
        │  (from Supabase)      │
        │  WHERE id = customer_id│
        └───────────────────────┘
                    │
                    ▼
        ┌───────────────────────┐
        │  Display:            │
        │  "Ticket by John Doe"│
        └───────────────────────┘
```

---

## 📊 Database Schema Comparison

### Supabase Tables

| Table | Primary Key | Foreign Keys | Purpose |
|-------|------------|-------------|---------|
| `auth.users` | `id` (UUID) | - | Authentication |
| `profiles` | `id` (UUID) | `id` → `auth.users.id` | User profiles & roles |
| `tickets` | `id` (UUID) | `customer_id` → `profiles.id`<br>`assigned_employee_id` → `profiles.id` | Reports/Tickets |
| `messages` | `id` (UUID) | `ticket_id` → `tickets.id`<br>`sender_id` → `profiles.id` | Ticket conversations |
| `attachments` | `id` (UUID) | `ticket_id` → `tickets.id`<br>`message_id` → `messages.id` | File attachments |
| `suggestions` | `suggest_id` (UUID) | `posted_by` → `profiles.id` | Community suggestions |
| `suggestion_comments` | `scom_id` (UUID) | `suggestion_id` → `suggestions.suggest_id`<br>`comment_from` → `profiles.id` | Suggestion comments |

### MySQL Tables

| Table | Primary Key | Foreign Keys | Purpose |
|-------|------------|-------------|---------|
| `announcements` | `id` (INT/BIGINT) | `posted_by` → `profiles.id` (UUID string) | News & Events |

---

## 🎯 Benefits Summary

### Technical Benefits

| Benefit | Description | Impact |
|---------|-------------|--------|
| **Modern Auth** | Supabase Auth with JWT tokens | Better security, scalable |
| **Stateless** | localStorage instead of sessions | Works across devices |
| **Flexible** | Different databases for different needs | Optimized storage |
| **Scalable** | Can scale Supabase and MySQL independently | Future-proof |

### Grading Benefits

| Benefit | Description | Score Impact |
|---------|-------------|--------------|
| **MySQL CRUD** | Announcements show full MySQL CRUD | ✅ Meets requirement |
| **Innovation** | Hybrid architecture is advanced | +2-3 points |
| **Technical Skills** | Shows understanding of multiple systems | +2-3 points |
| **Real-world** | Mimics production architecture | +1-2 points |

---

## ⚠️ Challenges & Solutions

| Challenge | Solution | Implementation |
|-----------|----------|----------------|
| **Token Validation** | Create middleware to validate JWT | Check token with Supabase API |
| **User Data Access** | Store user data in request after validation | Set `$request->user` in middleware |
| **Cross-DB Queries** | Fetch from both, merge in PHP | Helper methods to combine data |
| **Foreign Keys** | Store UUIDs as strings, validate in code | Application-level validation |
| **Token Refresh** | Auto-refresh expired tokens | JavaScript interceptor |

---

## 🚀 Quick Start Implementation

### Step 1: Install Dependencies
```bash
npm install @supabase/supabase-js
```

### Step 2: Create Supabase Client
```javascript
// resources/js/supabase-client.js
import { createClient } from '@supabase/supabase-js'

const supabaseUrl = 'YOUR_SUPABASE_URL'
const supabaseAnonKey = 'YOUR_SUPABASE_ANON_KEY'

export const supabase = createClient(supabaseUrl, supabaseAnonKey)
```

### Step 3: Update Login
```javascript
// resources/js/auth.js
import { supabase } from './supabase-client'

export async function login(email, password) {
  const { data, error } = await supabase.auth.signInWithPassword({
    email,
    password
  })
  
  if (data) {
    localStorage.setItem('supabase.auth.token', data.session.access_token)
    localStorage.setItem('user_data', JSON.stringify(data.user))
    return { success: true }
  }
  return { success: false, error }
}
```

### Step 4: Create Middleware
```php
// app/Http/Middleware/VerifySupabaseToken.php
public function handle($request, Closure $next) {
    $token = $request->header('Authorization');
    // Validate with Supabase
    // Set user in request
    return $next($request);
}
```

---

## 📝 Presentation Points

### What to Highlight

1. **Innovative Architecture**
   - "We implemented a hybrid database architecture using Supabase for user management and dynamic content, while MySQL handles structured announcements"

2. **Modern Authentication**
   - "We use Supabase Auth with JWT tokens stored in localStorage, providing a stateless, scalable authentication system"

3. **MySQL CRUD Demonstration**
   - "Announcements module demonstrates complete CRUD operations in MySQL, meeting the project requirements"

4. **Cross-Database Integration**
   - "Our system seamlessly integrates data from both databases, showing advanced technical understanding"

---

## ✅ Final Checklist Before Submission

- [ ] Supabase Auth implemented
- [ ] localStorage working for tokens
- [ ] Announcements using MySQL (full CRUD)
- [ ] Reports using Supabase (full CRUD)
- [ ] Suggestions using Supabase (full CRUD)
- [ ] Cross-database user references working
- [ ] All features tested
- [ ] Documentation updated
- [ ] Presentation prepared

---

## 📞 Questions to Discuss with Team

1. **Timeline**: Do we have enough time for this implementation?
2. **Complexity**: Is the team comfortable with this architecture?
3. **Testing**: How will we test both databases?
4. **Documentation**: Who will update the README?
5. **Presentation**: Who will explain the architecture?

---

**Status**: ✅ **RECOMMENDED** - This approach will significantly improve your project score and demonstrate advanced technical skills.

