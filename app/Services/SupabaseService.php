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

    // for file uploads
    public function uploadFile(UploadedFile $file, string $path, ?string $bucket = null): array
    {
        if (!$this->isConfigured()) {
            throw new Exception('Supabase is not configured. Please set SUPABASE_URL, SUPABASE_SERVICE_KEY, and SUPABASE_BUCKET in your .env file.');
        }

        $bucket = $bucket ?? $this->bucket;
        $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
        $filePath = trim($path . '/' . $fileName, '/');

        $http = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->serviceKey,
            'Content-Type' => $file->getMimeType(),
            'x-upsert' => 'true',
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

    public function getPublicUrl(string $bucket, string $path): string
    {
        $path = ltrim($path, '/');
        return "{$this->url}/storage/v1/object/public/{$bucket}/{$path}";
    }

    // for file deletion
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

    public function isConfigured(): bool
    {
        return !empty($this->url) && !empty($this->serviceKey) && !empty($this->bucket);
    }

    // legacy methods (not used anymore, kept for compatibility)
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

    // legacy method (not used anymore)
    public function select(string $table, array $filters = [], string $select = '*', string $orderBy = null, string $orderDirection = 'desc'): array
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
        
        foreach ($filters as $key => $value) {
            $encodedValue = urlencode($value);
            $url .= "&{$key}=eq.{$encodedValue}";
        }
        
        if ($orderBy) {
            $url .= "&order={$orderBy}.{$orderDirection}";
        }

        $response = $http->get($url);

        if (!$response->successful()) {
            $error = $response->json() ?? $response->body();
            throw new Exception('Failed to select data from Supabase: ' . json_encode($error));
        }

        return $response->json() ?? [];
    }

    // legacy method (not used anymore)
    public function update(string $table, array $filters, array $data): array
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

        $url = "{$this->url}/rest/v1/{$table}";
        
        foreach ($filters as $key => $value) {
            $url .= (strpos($url, '?') === false ? '?' : '&') . "{$key}=eq.{$value}";
        }

        $response = $http->patch($url, $data);

        if (!$response->successful()) {
            $error = $response->json() ?? $response->body();
            throw new Exception('Failed to update data in Supabase: ' . json_encode($error));
        }

        $result = $response->json();
        return is_array($result) && isset($result[0]) ? $result[0] : $result;
    }

    // legacy method (not used anymore)
    public function delete(string $table, array $filters): bool
    {
        if (!$this->isConfigured()) {
            throw new Exception('Supabase is not configured. Please set SUPABASE_URL and SUPABASE_SERVICE_KEY in your .env file.');
        }

        $http = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->serviceKey,
            'Content-Type' => 'application/json',
            'apikey' => $this->serviceKey,
        ]);

        if (!$this->verifySsl) {
            $http = $http->withoutVerifying();
        }

        $url = "{$this->url}/rest/v1/{$table}";
        
        foreach ($filters as $key => $value) {
            $url .= (strpos($url, '?') === false ? '?' : '&') . "{$key}=eq.{$value}";
        }

        $response = $http->delete($url);

        if (!$response->successful()) {
            $error = $response->json() ?? $response->body();
            throw new Exception('Failed to delete data from Supabase: ' . json_encode($error));
        }

        return true;
    }
}
