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
        Schema::table('pets',function(Blueprint $table){
            $table->text('short_description')->nullable()->after('description');
            $table->text('related_pets')->nullable()->after('short_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pets',function(Blueprint $table){
            $table->dropColumn('short_description');
            $table->dropColumn('related_pets');
        });
    }
};
