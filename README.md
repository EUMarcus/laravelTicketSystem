# Laravel Ticket System - How to Run

This is a Laravel 12 ticket system that uses Supabase for file storage.

## Prerequisites

Before running this project, make sure you have:

-   **PHP 8.2 or higher** installed
-   **Composer** installed ([getcomposer.org](https://getcomposer.org))
-   **Node.js and npm** installed ([nodejs.org](https://nodejs.org))
-   **Supabase account** (free at [supabase.com](https://supabase.com))

## Quick Start Guide

### Step 1: Navigate to the Project Directory

```bash
cd laravelTicketSystem
```

### Step 2: Install PHP Dependencies

```bash
composer install
```

### Step 3: Set Up Environment File

Create a `.env` file from the example (if it doesn't exist):

```bash
copy .env.example .env
```

Or manually create a `.env` file with these minimum required variables:

```env
APP_NAME="Laravel Ticket System"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost:8000

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=sqlite
# Or use MySQL/PostgreSQL if preferred

SESSION_DRIVER=database
SESSION_LIFETIME=120

# Supabase Configuration (Required for file uploads)
SUPABASE_URL=https://your-project-id.supabase.co
SUPABASE_KEY=your-anon-key-here
SUPABASE_SERVICE_KEY=your-service-role-key-here
SUPABASE_BUCKET=ticket-attachments
```

### Step 4: Generate Application Key

```bash
php artisan key:generate
```

### Step 5: Set Up Database``

**Option A: Use SQLite (Easiest for local development)**

Create the database file:

```bash
# On Windows
type nul > database\database.sqlite

# On Linux/Mac
touch database/database.sqlite
```

**Option B: Use MySQL/PostgreSQL**

Update your `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Then run migrations:

```bash
php artisan migrate
```

### Step 6: Set Up Supabase (Required for File Uploads)

1. **Create a Supabase account** at [supabase.com](https://supabase.com)
2. **Create a new project** and wait for it to be provisioned
3. **Get your credentials** from Settings → API:
    - Project URL
    - anon/public key
    - service_role key
4. **Create a storage bucket**:
    - Go to Storage → New bucket
    - Name: `ticket-attachments`
    - ✅ Check "Public bucket"
5. **Set storage policies** (see `SUPABASE_SETUP.md` for details)
6. **Update your `.env` file** with the Supabase credentials

For detailed Supabase setup, see:

-   `QUICK_START_SUPABASE.md` (5-minute quick guide)
-   `SUPABASE_SETUP.md` (detailed guide)

### Step 7: Install Node.js Dependencies

```bash
npm install
```

### Step 8: Build Frontend Assets

For development:

```bash
npm run dev
```

For production:

```bash
npm run build
```

### Step 9: Start the Development Server

Open a new terminal and run:

```bash
php artisan serve
```

The application will be available at: **http://localhost:8000**

## Running the Application

### Development Mode (Recommended)

**Terminal 1** - Start Laravel server:

```bash
php artisan serve
```

**Terminal 2** - Start Vite dev server (for hot reloading):

```bash
npm run dev
```

### Using Composer Scripts

You can also use the built-in dev script that runs everything:

```bash
composer run dev
```

This will start:

-   Laravel server
-   Queue worker
-   Log viewer
-   Vite dev server

## Accessing the Application

1. Open your browser and go to: **http://localhost:8000**
2. Register a new account or login
3. Create and manage tickets

## Common Commands

```bash
# Clear configuration cache
php artisan config:clear

# Clear all caches
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Run database migrations
php artisan migrate

# Run database migrations with fresh data (⚠️ deletes all data)
php artisan migrate:fresh

# Start queue worker (if using queues)
php artisan queue:work

# Run tests
php artisan test
```

## Troubleshooting

### "Class not found" errors

```bash
composer dump-autoload
```

### "Supabase is not configured" error

-   Check your `.env` file has all 4 Supabase variables
-   Run: `php artisan config:clear`

### File upload fails

-   Verify Supabase bucket is created and set to "Public"
-   Check storage policies are configured correctly
-   Ensure `SUPABASE_SERVICE_KEY` is the service_role key (not anon key)

### Port 8000 already in use

```bash
php artisan serve --port=8001
```

### Database connection errors

-   For SQLite: Make sure `database/database.sqlite` file exists
-   For MySQL/PostgreSQL: Verify credentials in `.env` file

## Project Structure

-   `app/` - Application code (Controllers, Models, Services)
-   `config/` - Configuration files
-   `database/` - Migrations and seeders
-   `public/` - Public assets and entry point
-   `resources/` - Views, CSS, and JavaScript
-   `routes/` - Route definitions
-   `storage/` - File storage and logs

## Additional Resources

-   Laravel Documentation: https://laravel.com/docs
-   Supabase Documentation: https://supabase.com/docs
-   Tailwind CSS Documentation: https://tailwindcss.com/docs
