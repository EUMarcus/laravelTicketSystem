<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('polls', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('created_by'); // staff/admin
            $table->string('question');
            $table->text('description')->nullable();
            $table->json('options'); // array of poll options
            $table->timestamp('deadline')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('profiles')->onDelete('cascade');
            $table->index('deadline');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('polls');
    }
};
