# Quick Start: Supabase Setup (5 Minutes)

## ✅ What You Need to Do

### 1. Create Supabase Account & Project
- Go to https://supabase.com
- Sign up/Login
- Create a new project
- Wait 2-3 minutes for setup

### 2. Get Your Credentials

In Supabase Dashboard → **Settings** → **API**:

Copy these 3 values:
- **Project URL**: `https://xxxxx.supabase.co`
- **anon key**: (under Project API keys)
- **service_role key**: (under Project API keys) ⚠️ Keep secret!

### 3. Create Storage Bucket

In Supabase Dashboard → **Storage**:
- Click **"New bucket"**
- Name: `ticket-attachments`
- ✅ **Check "Public bucket"**
- Create

### 4. Set Storage Policies

Still in Storage → `ticket-attachments` → **Policies**:

**Policy 1: Public Read**
- Operation: `SELECT`
- SQL: `(bucket_id = 'ticket-attachments'::text)`

**Policy 2: Authenticated Upload**
- Operation: `INSERT`
- SQL: `(bucket_id = 'ticket-attachments'::text) AND ((auth.role() = 'authenticated'::text))`

### 5. Update .env File

Add to your `.env`:
```env
SUPABASE_URL=https://your-project-id.supabase.co
SUPABASE_KEY=your-anon-key-here
SUPABASE_SERVICE_KEY=your-service-role-key-here
SUPABASE_BUCKET=ticket-attachments
```

### 6. Test It!

```bash
php artisan config:clear
php artisan serve
```

Try uploading a file in a ticket - it should now go to Supabase! 🎉

---

## ⚠️ Common Issues

**"Supabase is not configured" error?**
- Check `.env` file has all 4 variables
- Run: `php artisan config:clear`

**Upload fails with 403?**
- Bucket must be marked as "Public"
- Storage policies must be set correctly

**Files uploaded but can't see them?**
- Check bucket is public
- Verify the URL format in browser

---

## 📚 Full Guide

See `SUPABASE_SETUP.md` for detailed instructions and troubleshooting.

