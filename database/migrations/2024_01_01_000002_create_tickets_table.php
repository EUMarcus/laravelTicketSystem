<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('customer_id');
            $table->uuid('assigned_employee_id')->nullable();
            $table->string('subject');
            $table->text('description')->nullable();
            $table->string('status')->default('open'); // open, in_progress, resolved, closed
            $table->string('priority')->default('medium'); // low, medium, high, urgent
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->foreign('assigned_employee_id')->references('id')->on('profiles')->onDelete('set null');
            
            $table->index('customer_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};


