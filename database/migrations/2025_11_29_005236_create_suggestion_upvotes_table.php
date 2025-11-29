<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('suggestion_upvotes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('suggestion_id');
            $table->uuid('resident_id');
            $table->timestamps();

            $table->foreign('suggestion_id')->references('id')->on('suggestions')->onDelete('cascade');
            $table->foreign('resident_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->unique(['suggestion_id', 'resident_id']); // one upvote per resident per suggestion
            $table->index('suggestion_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suggestion_upvotes');
    }
};
