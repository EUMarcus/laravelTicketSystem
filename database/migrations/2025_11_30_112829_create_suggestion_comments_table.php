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
        Schema::create('suggestion_comments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('suggestion_id');
            $table->uuid('comment_from')->nullable();
            $table->text('comment');
            $table->timestamps();
            
            $table->foreign('suggestion_id')->references('id')->on('suggestions')->onDelete('cascade');
            $table->foreign('comment_from')->references('id')->on('profiles')->onDelete('set null');
            $table->index('suggestion_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suggestion_comments');
    }
};
