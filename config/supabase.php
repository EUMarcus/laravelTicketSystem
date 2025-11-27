<?php

return [
    'url' => env('SUPABASE_URL'),
    'key' => env('SUPABASE_KEY'), // anon/public key
    'service_key' => env('SUPABASE_SERVICE_KEY'), // service_role key (for server-side operations)
    'bucket' => env('SUPABASE_BUCKET', 'ticket-attachments'),
    'verify_ssl' => env('SUPABASE_VERIFY_SSL', false), // Set to false for Windows SSL certificate issues
];

