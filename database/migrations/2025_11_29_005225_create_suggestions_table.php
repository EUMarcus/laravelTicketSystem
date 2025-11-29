<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('suggestions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('resident_id')->nullable(); // null if anonymous
            $table->string('title');
            $table->text('description');
            $table->string('category')->nullable(); // programs, cleanliness, festivals, safety, youth, education, etc.
            $table->boolean('is_anonymous')->default(false);
            $table->integer('upvotes_count')->default(0);
            $table->integer('comments_count')->default(0);
            $table->timestamps();

            $table->foreign('resident_id')->references('id')->on('profiles')->onDelete('set null');
            $table->index('category');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suggestions');
    }
};
