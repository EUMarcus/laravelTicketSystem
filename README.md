# Kampay Ticket System

A Laravel-based ticket management system with file attachments stored in Supabase Storage.

## 📋 Project Overview

This is a **Laravel 12** ticket support system that allows:
- **Customer** role: Create tickets, view their own tickets, add messages and attachments
- **Employee/Admin** role: View all tickets, assign tickets, update status and priority
- File attachments stored in **Supabase Storage** (cloud storage)
- Real-time ticket management with status tracking (open, in_progress, resolved, closed)
- Priority levels: low, medium, high, urgent
- Message threads for ticket communication

### Tech Stack
- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade templates with Tailwind CSS 4
- **Storage**: Supabase Storage (for file attachments)
- **Database**: SQLite/MySQL/PostgreSQL (configurable)
- **Build Tool**: Vite

## 🚀 How to Run the Project

### Prerequisites

1. **PHP 8.2 or higher**
   ```bash
   php -v
   ```

2. **Composer** (PHP dependency manager)
   ```bash
   composer --version
   ```

3. **Node.js and npm** (for frontend assets)
   ```bash
   node -v
   npm -v
   ```

4. **Supabase Account** (for file storage)
   - Sign up at https://supabase.com
   - See `QUICK_START_SUPABASE.md` for quick setup

### Step 1: Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### Step 2: Environment Configuration

Create a `.env` file from the example (if it doesn't exist):

```bash
# On Windows PowerShell
Copy-Item .env.example .env

# On Linux/Mac
cp .env.example .env
```

**Or manually create `.env`** with these essential settings:

```env
APP_NAME="Kampay Ticket System"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database (SQLite - simplest for local development)
DB_CONNECTION=sqlite
# DB_DATABASE=laravel_tickets (uncomment if using MySQL/PostgreSQL)

# Supabase Configuration (REQUIRED for file uploads)
SUPABASE_URL=https://your-project-id.supabase.co
SUPABASE_KEY=your-anon-key-here
SUPABASE_SERVICE_KEY=your-service-role-key-here
SUPABASE_BUCKET=ticket-attachments
```

### Step 3: Generate Application Key

```bash
php artisan key:generate
```

### Step 4: Set Up Database

**Option A: SQLite (Easiest - Recommended for local dev)**

1. Create database file:
   ```bash
   # Windows PowerShell
   New-Item -ItemType File -Path database\database.sqlite

   # Linux/Mac
   touch database/database.sqlite
   ```

2. Update `.env`:
   ```env
   DB_CONNECTION=sqlite
   # Comment out or remove DB_DATABASE, DB_USERNAME, DB_PASSWORD
   ```

**Option B: MySQL/PostgreSQL**

Update `.env` with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_tickets
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Step 5: Run Migrations

```bash
php artisan migrate
```

This creates all necessary tables:
- `users` - Authentication
- `profiles` - User profiles with roles (customer/employee/admin)
- `tickets` - Support tickets
- `messages` - Ticket messages/threads
- `attachments` - File attachments
- `sessions`, `cache`, `jobs` - Laravel system tables

### Step 6: Set Up Supabase (For File Uploads)

**⚠️ Important**: File uploads won't work without Supabase configuration!

Follow the quick guide:
```bash
# Read the quick start guide
cat QUICK_START_SUPABASE.md
```

**Quick steps:**
1. Create Supabase account at https://supabase.com
2. Create a new project
3. Create a storage bucket named `ticket-attachments` (set as public)
4. Set storage policies (see `QUICK_START_SUPABASE.md`)
5. Copy credentials to `.env` file

See `SUPABASE_SETUP.md` for detailed instructions.

### Step 7: Build Frontend Assets

```bash
# Build for production
npm run build

# OR run in development mode (with hot reload)
npm run dev
```

### Step 8: Start the Development Server

**Option A: Simple Development Server**

```bash
# Terminal 1: Start Laravel server
php artisan serve

# Terminal 2: Start Vite dev server (if using npm run dev)
npm run dev
```

Then visit: **http://localhost:8000**

**Option B: Use Composer Script (All-in-one)**

```bash
composer run dev
```

This starts:
- Laravel server (port 8000)
- Queue worker
- Log viewer (Pail)
- Vite dev server

### Step 9: Create Your First User

1. Visit http://localhost:8000/register
2. Create an account (defaults to "customer" role)
3. To create an employee/admin, you can:
   - Use Laravel Tinker:
     ```bash
     php artisan tinker
     ```
   - Then run:
     ```php
     $user = \App\Models\User::create([
         'name' => 'Admin User',
         'email' => 'admin@example.com',
         'password' => bcrypt('password')
     ]);
     
     \App\Models\Profile::create([
         'id' => $user->id,
         'role' => 'admin',
         'name' => 'Admin User'
     ]);
     ```

## 📁 Project Structure

```
laravelTicketSystem/
├── app/
│   ├── Http/Controllers/
│   │   ├── Auth/          # Login/Register controllers
│   │   ├── TicketController.php
│   │   └── MessageController.php
│   ├── Models/
│   │   ├── User.php       # Authentication
│   │   ├── Profile.php    # User profiles with roles
│   │   ├── Ticket.php     # Support tickets
│   │   ├── Message.php    # Ticket messages
│   │   └── Attachment.php # File attachments
│   └── Services/
│       └── SupabaseService.php  # Supabase file storage
├── database/
│   └── migrations/        # Database schema
├── resources/
│   ├── views/             # Blade templates
│   │   ├── auth/         # Login/Register pages
│   │   ├── tickets/      # Ticket pages
│   │   └── layouts/      # Main layout
│   ├── css/app.css       # Tailwind CSS
│   └── js/app.js         # JavaScript
├── routes/
│   └── web.php           # Application routes
└── config/
    └── supabase.php      # Supabase configuration
```

## 🎯 Key Features

### Authentication
- User registration and login
- Session-based authentication
- Role-based access control

### Tickets
- Create tickets with subject, description, priority
- Upload multiple file attachments
- View ticket list (filtered by role)
- Update ticket status and priority
- Assign tickets to employees

### Messages
- Add messages to tickets
- View message threads
- Attach files to messages

### File Storage
- Files stored in Supabase Storage
- Public URLs for file access
- Support for various file types (images, PDFs, documents)

## 🔧 Common Commands

```bash
# Clear configuration cache
php artisan config:clear

# Clear all caches
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Run migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Create a new migration
php artisan make:migration create_table_name

# Access Laravel Tinker (interactive shell)
php artisan tinker

# Run tests
php artisan test
```

## 🐛 Troubleshooting

### "Supabase is not configured" error
- Check `.env` has all Supabase variables
- Run: `php artisan config:clear`

### File upload fails
- Verify Supabase bucket exists and is public
- Check storage policies in Supabase dashboard
- Ensure `SUPABASE_SERVICE_KEY` is the service_role key (not anon key)

### Database connection error
- Check `.env` database settings
- For SQLite: ensure `database/database.sqlite` exists
- For MySQL/PostgreSQL: ensure database exists and credentials are correct

### Assets not loading
- Run `npm run build` or `npm run dev`
- Clear browser cache
- Check `public/build` directory exists

### "Class not found" errors
- Run `composer dump-autoload`
- Run `php artisan optimize:clear`

## 📚 Additional Documentation

- `QUICK_START_SUPABASE.md` - Quick Supabase setup (5 minutes)
- `SUPABASE_SETUP.md` - Detailed Supabase configuration guide

## 🎨 Customization

The project uses Tailwind CSS with custom Kampay brand colors. Edit `resources/css/app.css` to customize styling.

## 📝 License

This project appears to be for educational purposes.

---

**Happy coding! 🚀**

