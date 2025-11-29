<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('posted_by'); // staff/admin who posted
            $table->string('title');
            $table->text('content');
            $table->string('category')->nullable(); // festival, disaster, health, meeting, schedule, recap, etc.
            $table->string('image_url')->nullable();
            $table->timestamps();

            $table->foreign('posted_by')->references('id')->on('profiles')->onDelete('cascade');
            $table->index('category');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
