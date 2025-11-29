<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('poll_votes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('poll_id');
            $table->uuid('resident_id');
            $table->string('selected_option'); // the option they voted for
            $table->timestamps();

            $table->foreign('poll_id')->references('id')->on('polls')->onDelete('cascade');
            $table->foreign('resident_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->unique(['poll_id', 'resident_id']); // one vote per resident per poll
            $table->index('poll_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('poll_votes');
    }
};
