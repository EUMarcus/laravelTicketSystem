<?php

namespace App\Jobs;

use App\Models\Attachment;
use App\Services\SupabaseService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class UploadFileToSupabase implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     */
    public $tries = 3;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $attachmentId,
        public string $tempFilePath,
        public string $storagePath,
        public string $originalFileName,
        public string $fileType,
        public int $fileSize
    ) {}

    /**
     * Execute the job.
     */
    public function handle(SupabaseService $supabase): void
    {
        try {
            // Get the full path to the temporary file
            $fullPath = storage_path('app/' . $this->tempFilePath);
            
        if (!file_exists($fullPath)) {
            throw new \Exception("Temporary file not found: {$fullPath}");
        }
            
            // Create an UploadedFile instance for SupabaseService
            $uploadedFile = new \Illuminate\Http\UploadedFile(
                $fullPath,
                $this->originalFileName,
                $this->fileType,
                null,
                true // test mode
            );
            
            // Upload to Supabase
            $upload = $supabase->uploadFile($uploadedFile, $this->storagePath);
            
            // Update the attachment record
            Attachment::where('id', $this->attachmentId)->update([
                'file_name' => $upload['name'],
                'file_path' => $upload['path'],
                'file_url' => $upload['url'],
            ]);
            
            // Clean up temporary file
            Storage::delete($this->tempFilePath);
        } catch (\Exception $e) {
            // Mark attachment as failed
            Attachment::where('id', $this->attachmentId)->update([
                'file_url' => null,
                'file_path' => 'upload_failed',
            ]);
            
            // Clean up temporary file even on failure
            Storage::delete($this->tempFilePath);
            
            throw $e;
        }
    }
}

