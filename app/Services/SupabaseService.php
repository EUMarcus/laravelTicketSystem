<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\UploadedFile;
use Exception;

class SupabaseService
{
    protected $url;
    protected $key;
    protected $serviceKey;
    protected $bucket;

    protected $verifySsl;

    public function __construct()
    {
        $this->url = rtrim(config('supabase.url', ''), '/');
        $this->key = config('supabase.key');
        $this->serviceKey = config('supabase.service_key');
        $this->bucket = config('supabase.bucket', 'ticket-attachments');
        $this->verifySsl = config('supabase.verify_ssl', false);
    }

    /**
     * Upload a file to Supabase Storage
     */
    public function uploadFile(UploadedFile $file, string $path, ?string $bucket = null): array
    {
        if (!$this->isConfigured()) {
            throw new Exception('Supabase is not configured. Please set SUPABASE_URL, SUPABASE_SERVICE_KEY, and SUPABASE_BUCKET in your .env file.');
        }

        $bucket = $bucket ?? $this->bucket;
        $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
        $filePath = trim($path . '/' . $fileName, '/');

        // Upload to Supabase Storage using the Storage API
        $http = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->serviceKey,
            'Content-Type' => $file->getMimeType(),
            'x-upsert' => 'true', // Overwrite if exists
        ]);

        if (!$this->verifySsl) {
            $http = $http->withoutVerifying();
        }

        $response = $http->withBody(
            file_get_contents($file->getRealPath()),
            $file->getMimeType()
        )->put(
            "{$this->url}/storage/v1/object/{$bucket}/{$filePath}"
        );

        if (!$response->successful()) {
            $error = $response->json() ?? $response->body();
            throw new Exception('Failed to upload file to Supabase: ' . json_encode($error));
        }

        $publicUrl = $this->getPublicUrl($bucket, $filePath);

        return [
            'path' => $filePath,
            'name' => $fileName,
            'url' => $publicUrl,
        ];
    }

    /**
     * Get public URL for a file in Supabase Storage
     */
    public function getPublicUrl(string $bucket, string $path): string
    {
        // Remove leading slash if present
        $path = ltrim($path, '/');
        
        // Supabase public URL format
        return "{$this->url}/storage/v1/object/public/{$bucket}/{$path}";
    }

    /**
     * Delete a file from Supabase Storage
     */
    public function deleteFile(string $path, ?string $bucket = null): bool
    {
        if (!$this->isConfigured()) {
            return false;
        }

        $bucket = $bucket ?? $this->bucket;
        $path = ltrim($path, '/');

        $http = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->serviceKey,
        ]);

        if (!$this->verifySsl) {
            $http = $http->withoutVerifying();
        }

        $response = $http->delete(
            "{$this->url}/storage/v1/object/{$bucket}",
            ['prefixes' => [$path]]
        );

        return $response->successful();
    }

    /**
     * Check if Supabase is configured
     */
    public function isConfigured(): bool
    {
        return !empty($this->url) && !empty($this->serviceKey) && !empty($this->bucket);
    }

    /**
     * Insert data into a Supabase table
     */
    public function insert(string $table, array $data): array
    {
        if (!$this->isConfigured()) {
            throw new Exception('Supabase is not configured. Please set SUPABASE_URL and SUPABASE_SERVICE_KEY in your .env file.');
        }

        $http = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->serviceKey,
            'Content-Type' => 'application/json',
            'apikey' => $this->serviceKey,
            'Prefer' => 'return=representation',
        ]);

        if (!$this->verifySsl) {
            $http = $http->withoutVerifying();
        }

        $response = $http->post(
            "{$this->url}/rest/v1/{$table}",
            $data
        );

        if (!$response->successful()) {
            $error = $response->json() ?? $response->body();
            throw new Exception('Failed to insert data into Supabase: ' . json_encode($error));
        }

        $result = $response->json();
        return is_array($result) && isset($result[0]) ? $result[0] : $result;
    }

    /**
     * Select data from a Supabase table
     */
    public function select(string $table, array $filters = [], string $select = '*'): array
    {
        if (!$this->isConfigured()) {
            throw new Exception('Supabase is not configured. Please set SUPABASE_URL and SUPABASE_SERVICE_KEY in your .env file.');
        }

        $http = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->serviceKey,
            'Content-Type' => 'application/json',
            'apikey' => $this->serviceKey,
            'Prefer' => 'return=representation',
        ]);

        if (!$this->verifySsl) {
            $http = $http->withoutVerifying();
        }

        $url = "{$this->url}/rest/v1/{$table}?select={$select}";
        
        // Add filters as query parameters
        foreach ($filters as $key => $value) {
            $url .= "&{$key}=eq.{$value}";
        }

        $response = $http->get($url);

        if (!$response->successful()) {
            $error = $response->json() ?? $response->body();
            throw new Exception('Failed to select data from Supabase: ' . json_encode($error));
        }

        return $response->json() ?? [];
    }
}
