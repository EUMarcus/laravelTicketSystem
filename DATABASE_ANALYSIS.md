# Database Analysis & Breakdown

## Overview

This document provides a comprehensive analysis of the Kampay Ticket System database structure, relationships, and architecture.

---

## Database Architecture

### **Primary Database: MySQL**
- **Connection**: MySQL 8.0+
- **Database Name**: `kampay_ticket_system`
- **Character Set**: `utf8mb4`
- **Collation**: `utf8mb4_unicode_ci`
- **Primary Key Type**: UUID (36-character string)

### **File Storage: Supabase Storage**
- **Service**: Supabase Storage API
- **Bucket**: `ticket-attachments`
- **Purpose**: Stores actual file uploads (images, PDFs, documents)
- **Note**: File metadata (paths, URLs, sizes) is stored in MySQL `attachments` table

---

## Database Tables

### 1. **users**
**Purpose**: User authentication and basic information

| Column | Type | Description |
|--------|------|-------------|
| `id` | UUID (PK) | Unique user identifier |
| `name` | VARCHAR(255) | User's full name |
| `email` | VARCHAR(255) | Unique email address |
| `password` | VARCHAR(255) | Hashed password |
| `voters_id` | VARCHAR(22) | Unique voters ID (alphanumeric) |
| `contact_number` | VARCHAR(20) | Phone number |
| `address` | VARCHAR(255) | Physical address |
| `email_verified_at` | TIMESTAMP | Email verification timestamp |
| `remember_token` | VARCHAR(100) | Remember me token |
| `created_at` | TIMESTAMP | Record creation time |
| `updated_at` | TIMESTAMP | Record update time |

**Relationships**:
- One-to-One with `profiles` (via `id`)

**Indexes**:
- Primary key on `id`
- Unique index on `email`
- Unique index on `voters_id`

---

### 2. **profiles**
**Purpose**: User profiles with roles and extended information

| Column | Type | Description |
|--------|------|-------------|
| `id` | UUID (PK, FK) | References `users.id` |
| `role` | VARCHAR(255) | User role: `citizen`, `customer`, `employee`, `admin` |
| `name` | VARCHAR(255) | Display name |
| `avatar_url` | VARCHAR(255) | Optional avatar image URL |
| `created_at` | TIMESTAMP | Record creation time |
| `updated_at` | TIMESTAMP | Record update time |

**Relationships**:
- Belongs to `users` (via `id`)
- Has many `tickets` (as customer)
- Has many `tickets` (as assigned employee)
- Has many `messages` (as sender)
- Has many `suggestions` (as author)
- Has many `suggestion_comments` (as commenter)
- Has many `announcements` (as author)

**Indexes**:
- Primary key on `id`
- Foreign key to `users.id` (CASCADE on delete)

**Role Values**:
- `citizen` / `customer`: Regular community members
- `employee`: Staff members with admin access
- `admin`: Full administrative access

---

### 3. **tickets**
**Purpose**: Community reports/issues/tickets

| Column | Type | Description |
|--------|------|-------------|
| `id` | UUID (PK) | Unique ticket identifier |
| `customer_id` | UUID (FK) | References `profiles.id` (ticket creator) |
| `assigned_employee_id` | UUID (FK, nullable) | References `profiles.id` (assigned staff) |
| `subject` | VARCHAR(255) | Ticket subject/title |
| `description` | TEXT | Detailed description |
| `status` | VARCHAR(255) | Status: `open`, `in_progress`, `resolved`, `closed` |
| `priority` | VARCHAR(255) | Priority: `low`, `medium`, `high`, `urgent` |
| `resolved_at` | TIMESTAMP (nullable) | Resolution timestamp |
| `created_at` | TIMESTAMP | Record creation time |
| `updated_at` | TIMESTAMP | Record update time |

**Relationships**:
- Belongs to `profiles` (as customer)
- Belongs to `profiles` (as assigned employee)
- Has many `messages`
- Has many `attachments`

**Indexes**:
- Primary key on `id`
- Foreign key to `profiles.id` (customer_id, CASCADE)
- Foreign key to `profiles.id` (assigned_employee_id, SET NULL)
- Index on `customer_id`
- Index on `status`

**Status Flow**:
```
open → in_progress → resolved → closed
```

---

### 4. **messages**
**Purpose**: Messages/chat within tickets

| Column | Type | Description |
|--------|------|-------------|
| `id` | UUID (PK) | Unique message identifier |
| `ticket_id` | UUID (FK) | References `tickets.id` |
| `sender_id` | UUID (FK) | References `profiles.id` (message sender) |
| `content` | TEXT (nullable) | Message content |
| `created_at` | TIMESTAMP | Record creation time |
| `updated_at` | TIMESTAMP | Record update time |

**Relationships**:
- Belongs to `tickets`
- Belongs to `profiles` (as sender)
- Has many `attachments`

**Indexes**:
- Primary key on `id`
- Foreign key to `tickets.id` (CASCADE)
- Foreign key to `profiles.id` (sender_id, CASCADE)
- Index on `ticket_id`

---

### 5. **attachments**
**Purpose**: File attachment metadata

| Column | Type | Description |
|--------|------|-------------|
| `id` | UUID (PK) | Unique attachment identifier |
| `message_id` | UUID (FK, nullable) | References `messages.id` |
| `ticket_id` | UUID (FK, nullable) | References `tickets.id` |
| `file_name` | VARCHAR(255) | Original file name |
| `file_path` | VARCHAR(255) | Storage path (Supabase or local) |
| `file_url` | VARCHAR(255) | Public access URL |
| `file_type` | VARCHAR(255) | MIME type (e.g., image/jpeg) |
| `file_size` | INTEGER | File size in bytes |
| `uploaded_by` | UUID (FK) | References `profiles.id` |
| `created_at` | TIMESTAMP | Record creation time |
| `updated_at` | TIMESTAMP | Record update time |

**Relationships**:
- Belongs to `messages` (optional)
- Belongs to `tickets` (optional)
- Belongs to `profiles` (as uploader)

**Indexes**:
- Primary key on `id`
- Foreign key to `messages.id` (CASCADE)
- Foreign key to `tickets.id` (CASCADE)
- Foreign key to `profiles.id` (uploaded_by, CASCADE)
- Index on `ticket_id`
- Index on `message_id`

**File Storage**:
- Actual files stored in **Supabase Storage** bucket: `ticket-attachments`
- Fallback to local storage if Supabase not configured
- Path format: `tickets/{ticket_id}/` or `tickets/{ticket_id}/messages/`

---

### 6. **suggestions**
**Purpose**: Community suggestions/ideas

| Column | Type | Description |
|--------|------|-------------|
| `id` | UUID (PK) | Unique suggestion identifier |
| `title` | VARCHAR(255) | Suggestion title |
| `category` | VARCHAR(255) | Category (Health, Infrastructure, Events, etc.) |
| `full_content` | TEXT | Full suggestion content |
| `status` | VARCHAR(255) | Status: `pending`, `considering`, `processing`, `approved`, `rejected` |
| `posted_by` | UUID (FK, nullable) | References `profiles.id` (author) |
| `created_at` | TIMESTAMP | Record creation time |
| `updated_at` | TIMESTAMP | Record update time |

**Relationships**:
- Belongs to `profiles` (as author)
- Has many `suggestion_comments`

**Indexes**:
- Primary key on `id`
- Foreign key to `profiles.id` (posted_by, SET NULL)
- Index on `status`
- Index on `created_at`

**Status Values**:
- `pending`: Newly submitted, awaiting review
- `considering`: Under consideration by staff
- `processing`: Being implemented
- `approved`: Approved for implementation
- `rejected`: Not approved

---

### 7. **suggestion_comments**
**Purpose**: Comments on suggestions

| Column | Type | Description |
|--------|------|-------------|
| `id` | UUID (PK) | Unique comment identifier |
| `suggestion_id` | UUID (FK) | References `suggestions.id` |
| `comment_from` | UUID (FK, nullable) | References `profiles.id` (commenter) |
| `comment` | TEXT | Comment content |
| `created_at` | TIMESTAMP | Record creation time |
| `updated_at` | TIMESTAMP | Record update time |

**Relationships**:
- Belongs to `suggestions`
- Belongs to `profiles` (as commenter)

**Indexes**:
- Primary key on `id`
- Foreign key to `suggestions.id` (CASCADE)
- Foreign key to `profiles.id` (comment_from, SET NULL)
- Index on `suggestion_id`

---

### 8. **announcements**
**Purpose**: Community announcements and news

| Column | Type | Description |
|--------|------|-------------|
| `id` | UUID (PK) | Unique announcement identifier |
| `title` | VARCHAR(255) | Announcement title |
| `category` | VARCHAR(255) | Category (Event, Health, Meeting, etc.) |
| `full_content` | TEXT | Full announcement content |
| `urgent` | BOOLEAN | Urgent flag (default: false) |
| `posted_by` | UUID (FK, nullable) | References `profiles.id` (author, staff only) |
| `start_date` | TIMESTAMP (nullable) | Event start date/time |
| `end_date` | TIMESTAMP (nullable) | Event end date/time |
| `created_at` | TIMESTAMP | Record creation time |
| `updated_at` | TIMESTAMP | Record update time |

**Relationships**:
- Belongs to `profiles` (as author)

**Indexes**:
- Primary key on `id`
- Foreign key to `profiles.id` (posted_by, SET NULL)
- Index on `created_at`
- Index on `urgent`

**Category Values**:
- `Event`, `Health`, `Meeting`, `Service`, `Infrastructure`, `Safety`, `Education`, `Other`

---

### 9. **sessions**
**Purpose**: User session storage

| Column | Type | Description |
|--------|------|-------------|
| `id` | VARCHAR(255) (PK) | Session ID |
| `user_id` | UUID (FK, nullable) | References `users.id` |
| `ip_address` | VARCHAR(45) | Client IP address |
| `user_agent` | TEXT | Browser user agent |
| `payload` | LONGTEXT | Session data |
| `last_activity` | INTEGER | Last activity timestamp |

**Relationships**:
- Belongs to `users` (optional)

**Indexes**:
- Primary key on `id`
- Index on `user_id`
- Index on `last_activity`

---

### 10. **cache**
**Purpose**: Application cache storage

| Column | Type | Description |
|--------|------|-------------|
| `key` | VARCHAR(255) (PK) | Cache key |
| `value` | MEDIUMTEXT | Cached value |
| `expiration` | INTEGER | Expiration timestamp |

**Indexes**:
- Primary key on `key`

---

### 11. **jobs**
**Purpose**: Queue job storage

| Column | Type | Description |
|--------|------|-------------|
| `id` | BIGINT (PK) | Job ID |
| `queue` | VARCHAR(255) | Queue name |
| `payload` | LONGTEXT | Job data |
| `attempts` | TINYINT | Attempt count |
| `reserved_at` | INTEGER (nullable) | Reservation timestamp |
| `available_at` | INTEGER | Available timestamp |
| `created_at` | INTEGER | Creation timestamp |

**Indexes**:
- Primary key on `id`
- Index on `queue`

---

### 12. **migrations**
**Purpose**: Migration tracking

| Column | Type | Description |
|--------|------|-------------|
| `id` | BIGINT (PK) | Migration ID |
| `migration` | VARCHAR(255) | Migration filename |
| `batch` | INTEGER | Batch number |

**Indexes**:
- Primary key on `id`

---

## Entity Relationship Diagram (ERD)

```
users (1) ──────── (1) profiles
                          │
                          ├─── (1:N) tickets (customer_id)
                          ├─── (1:N) tickets (assigned_employee_id)
                          ├─── (1:N) messages (sender_id)
                          ├─── (1:N) suggestions (posted_by)
                          ├─── (1:N) suggestion_comments (comment_from)
                          ├─── (1:N) announcements (posted_by)
                          └─── (1:N) attachments (uploaded_by)

tickets (1) ──────── (N) messages
    │                    │
    │                    └─── (1:N) attachments (message_id)
    │
    └─── (1:N) attachments (ticket_id)

suggestions (1) ──────── (N) suggestion_comments
```

---

## Data Flow

### **User Registration Flow**:
1. User registers → `users` table created
2. `profiles` record automatically created with same UUID
3. Role assigned: `citizen`/`customer` or `employee`/`admin`

### **Ticket/Report Flow**:
1. User creates ticket → `tickets` record created
2. If files attached → Uploaded to Supabase Storage
3. File metadata saved to `attachments` table
4. Staff can assign ticket → `assigned_employee_id` updated
5. Messages added → `messages` table
6. Status updated → `status` field, `resolved_at` timestamp

### **Suggestion Flow**:
1. User submits suggestion → `suggestions` record created
2. Status: `pending` → Staff reviews → `considering`/`processing`/`approved`/`rejected`
3. Comments added → `suggestion_comments` table

### **Announcement Flow**:
1. Staff creates announcement → `announcements` record created
2. Can set `urgent` flag and date ranges
3. Visible to all users

---

## Storage Architecture

### **MySQL (Relational Data)**:
- All structured data (users, profiles, tickets, messages, suggestions, announcements)
- Relationships and foreign keys
- Indexes for performance
- Transactions for data integrity

### **Supabase Storage (Files)**:
- Actual file storage (images, PDFs, documents)
- Public URLs for file access
- Organized by path: `tickets/{ticket_id}/` or `tickets/{ticket_id}/messages/`
- Fallback to local storage if Supabase not configured

---

## Security Considerations

1. **Passwords**: Hashed using bcrypt (Laravel default)
2. **UUIDs**: Used for all primary keys (prevents enumeration attacks)
3. **Foreign Keys**: Enforced at database level (CASCADE/SET NULL)
4. **File Uploads**: Validated (type, size limits: 10MB max)
5. **Role-Based Access**: Enforced at application level
6. **Sessions**: Stored in database (not cookies)

---

## Performance Optimizations

1. **Indexes**: Added on frequently queried columns
   - `status`, `customer_id`, `ticket_id`, `created_at`
2. **Eager Loading**: Relationships loaded with `with()` to prevent N+1 queries
3. **Pagination**: Used for large datasets (15-20 items per page)
4. **Caching**: Available via `cache` table (Laravel cache driver)

---

## Migration History

| Migration | Description |
|-----------|-------------|
| `0001_01_01_000000_create_users_table` | Base users table |
| `0001_01_01_000001_create_cache_table` | Cache storage |
| `0001_01_01_000002_create_jobs_table` | Queue jobs |
| `2024_01_01_000001_create_profiles_table` | User profiles |
| `2024_01_01_000002_create_tickets_table` | Tickets/reports |
| `2024_01_01_000003_create_messages_table` | Ticket messages |
| `2024_01_01_000004_create_attachments_table` | File attachments |
| `2025_11_27_213946_fix_sessions_user_id_to_uuid` | Sessions UUID fix |
| `2025_11_29_073036_add_voters_id_contact_address_to_users_table` | User fields |
| `2025_11_30_112814_create_suggestions_table` | Suggestions |
| `2025_11_30_112829_create_suggestion_comments_table` | Suggestion comments |
| `2025_11_30_112832_create_announcements_table` | Announcements |

---

## Common Queries

### Get all tickets with customer and employee info:
```sql
SELECT t.*, 
       c.name as customer_name, 
       e.name as employee_name
FROM tickets t
LEFT JOIN profiles c ON t.customer_id = c.id
LEFT JOIN profiles e ON t.assigned_employee_id = e.id;
```

### Get suggestions with comment counts:
```sql
SELECT s.*, 
       COUNT(sc.id) as comment_count
FROM suggestions s
LEFT JOIN suggestion_comments sc ON s.id = sc.suggestion_id
GROUP BY s.id;
```

### Get urgent announcements:
```sql
SELECT * FROM announcements 
WHERE urgent = true 
ORDER BY created_at DESC;
```

---

## Backup Recommendations

1. **MySQL Database**: Regular mysqldump backups
2. **Supabase Storage**: Backup bucket contents
3. **Environment Files**: Secure backup of `.env` (never commit to Git)
4. **Migrations**: All migrations in version control

---

## Notes

- All timestamps use MySQL `TIMESTAMP` type
- UUIDs are stored as `CHAR(36)` or `VARCHAR(36)` in MySQL
- Foreign keys use `ON DELETE CASCADE` or `ON DELETE SET NULL` as appropriate
- File paths in `attachments` table point to Supabase Storage URLs or local storage paths

