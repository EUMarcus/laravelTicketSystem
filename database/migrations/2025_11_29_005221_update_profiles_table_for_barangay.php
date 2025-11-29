<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('address')->nullable()->after('name');
            $table->string('contact_number')->nullable()->after('address');
            $table->string('email')->nullable()->after('contact_number');
            $table->boolean('is_verified')->default(false)->after('email');
            $table->string('role')->default('resident')->change(); // resident, staff, admin
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn(['address', 'contact_number', 'email', 'is_verified']);
            $table->string('role')->default('customer')->change();
        });
    }
};
