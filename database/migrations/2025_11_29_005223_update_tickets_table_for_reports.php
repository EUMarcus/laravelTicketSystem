<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('category')->nullable()->after('subject');
            $table->string('location')->nullable()->after('description');
            $table->string('map_link')->nullable()->after('location');
            $table->boolean('is_anonymous')->default(false)->after('priority');
            $table->string('contact_number')->nullable()->after('is_anonymous');
        });
        
        // Rename column separately for better compatibility
        if (Schema::hasColumn('tickets', 'subject')) {
            Schema::table('tickets', function (Blueprint $table) {
                $table->renameColumn('subject', 'title');
            });
        }
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn(['category', 'location', 'map_link', 'is_anonymous', 'contact_number']);
            $table->renameColumn('title', 'subject');
            $table->string('status')->default('open')->change();
            $table->string('priority')->default('medium')->change();
        });
    }
};
