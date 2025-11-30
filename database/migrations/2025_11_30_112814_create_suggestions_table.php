<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('suggestions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('category')->nullable();
            $table->text('full_content');
            $table->string('status')->default('pending'); // pending, considering, processing, approved, rejected
            $table->uuid('posted_by')->nullable();
            $table->timestamps();
            
            $table->foreign('posted_by')->references('id')->on('profiles')->onDelete('set null');
            $table->index('status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suggestions');
    }
};
