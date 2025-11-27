<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('message_id')->nullable();
            $table->uuid('ticket_id')->nullable();
            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_url');
            $table->string('file_type')->nullable();
            $table->integer('file_size')->nullable();
            $table->uuid('uploaded_by');
            $table->timestamps();

            $table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade');
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            $table->foreign('uploaded_by')->references('id')->on('profiles')->onDelete('cascade');
            
            $table->index('ticket_id');
            $table->index('message_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};


