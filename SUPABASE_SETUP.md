# Supabase Setup Guide for Kampay Ticket System

## 📋 Prerequisites

1. A Supabase account (sign up at https://supabase.com)
2. A Supabase project created

## 🚀 Step-by-Step Setup

### Step 1: Create a Supabase Project

1. Go to https://supabase.com and sign in
2. Click "New Project"
3. Fill in:
   - **Name**: Kampay Ticket System (or your preferred name)
   - **Database Password**: Create a strong password (save it!)
   - **Region**: Choose closest to your users
4. Click "Create new project"
5. Wait for project to be provisioned (2-3 minutes)

### Step 2: Get Your Supabase Credentials

1. In your Supabase project dashboard, go to **Settings** (gear icon) → **API**
2. Find these values and copy them:

   - **Project URL**: Under "Project URL" section
     - Looks like: `https://xxxxxxxxxxxxx.supabase.co`
   
   - **anon/public key**: Under "Project API keys" → "anon public"
     - This is your `SUPABASE_KEY`
   
   - **service_role key**: Under "Project API keys" → "service_role"
     - ⚠️ **Keep this secret!** Never expose this in frontend code
     - This is your `SUPABASE_SERVICE_KEY`

### Step 3: Create Storage Bucket

1. In Supabase dashboard, go to **Storage** (left sidebar)
2. Click **"New bucket"**
3. Configure the bucket:
   - **Name**: `ticket-attachments`
   - **Public bucket**: ✅ **CHECK THIS** (so files can be accessed via public URLs)
   - **File size limit**: Set to 10MB (10485760 bytes) or your preference
   - **Allowed MIME types**: Leave empty for all types, or specify:
     - `image/*,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document`
4. Click **"Create bucket"**

### Step 4: Set Up Storage Policies (Important for Security)

1. Still in Storage, click on your `ticket-attachments` bucket
2. Go to **"Policies"** tab
3. Click **"New policy"** → **"For full customization"**

#### Policy 1: Allow Authenticated Users to Upload
- **Policy name**: `Allow authenticated uploads`
- **Allowed operation**: `INSERT`
- **Policy definition**: Paste this SQL:
```sql
(bucket_id = 'ticket-attachments'::text) AND ((auth.role() = 'authenticated'::text))
```

#### Policy 2: Allow Public Read Access
- **Policy name**: `Allow public reads`
- **Allowed operation**: `SELECT`
- **Policy definition**: Paste this SQL:
```sql
(bucket_id = 'ticket-attachments'::text)
```

#### Policy 3: Allow Users to Delete Their Own Files
- **Policy name**: `Allow authenticated deletes`
- **Allowed operation**: `DELETE`
- **Policy definition**: Paste this SQL:
```sql
(bucket_id = 'ticket-attachments'::text) AND ((auth.role() = 'authenticated'::text))
```

### Step 5: Update Your .env File

Add these lines to your `.env` file:

```env
# Supabase Configuration
SUPABASE_URL=https://your-project-id.supabase.co
SUPABASE_KEY=your-anon-public-key-here
SUPABASE_SERVICE_KEY=your-service-role-key-here
SUPABASE_BUCKET=ticket-attachments
```

**Replace:**
- `your-project-id.supabase.co` with your actual Project URL
- `your-anon-public-key-here` with your anon/public key
- `your-service-role-key-here` with your service_role key

### Step 6: Test the Connection

Run this command to test if your Supabase connection works:

```bash
php artisan tinker
```

Then in tinker, run:
```php
$supabase = app(\App\Services\SupabaseService::class);
$supabase->isConfigured(); // Should return true
```

## 📊 Database Setup (Optional - if using Supabase PostgreSQL)

If you want to use Supabase's PostgreSQL database instead of local SQLite:

### Option A: Use Supabase Database

1. In Supabase dashboard, go to **Settings** → **Database**
2. Find **Connection string** → **Connection pooling**
3. Copy the connection string (looks like: `postgresql://postgres:password@...`)

Update your `.env`:
```env
DB_CONNECTION=pgsql
DB_HOST=db.your-project-id.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=your-database-password
```

### Option B: Keep Using Local Database

You can keep using SQLite/MySQL locally and only use Supabase for file storage. This is fine!

## 🔧 Troubleshooting

### Error: "Failed to upload file to Supabase"
- ✅ Check your `SUPABASE_URL` is correct
- ✅ Verify `SUPABASE_SERVICE_KEY` is the service_role key (not anon key)
- ✅ Ensure the bucket `ticket-attachments` exists
- ✅ Make sure the bucket is public

### Files uploaded but can't access them
- ✅ Check bucket is marked as "Public"
- ✅ Verify the storage policies allow public reads
- ✅ Check the file URL format is correct

### 403 Forbidden errors
- ✅ Verify storage policies are set up correctly
- ✅ Check you're using the service_role key for uploads (in backend)
- ✅ Ensure bucket name matches in `.env`

### CORS errors (if using from frontend)
- ✅ In Supabase dashboard, go to **Settings** → **API**
- ✅ Add your domain to **Additional allowed origins**

## 🎯 What Changed in the Code

The system now:
- ✅ Uploads files directly to Supabase Storage
- ✅ Generates public URLs for file access
- ✅ No longer uses Laravel's local storage
- ✅ All files are stored in the cloud

## 🔒 Security Notes

1. **Never commit your `.env` file** to version control
2. **service_role key** should only be used server-side (which we do)
3. The **anon key** can be used in frontend (but we use service_role for uploads)
4. Make sure storage policies are correctly set up for your security needs

## ✅ Verification Checklist

- [ ] Supabase project created
- [ ] `ticket-attachments` bucket created and set to public
- [ ] Storage policies configured
- [ ] `.env` file updated with all credentials
- [ ] Test upload works
- [ ] Files are accessible via public URLs

Once all steps are complete, your ticket system will store all files in Supabase Storage! 🎉

