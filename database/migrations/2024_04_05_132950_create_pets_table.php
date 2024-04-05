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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->integer('age');
            $table->foreignId('category_id')->constrained('pet_categories')->onDelete('cascade');
            $table->foreignId('breed_id')->nullable()->constrained()->onDelete('cascade');
            $table->enum('is_featured',['Yes','No'])->default('No');
            $table->enum('gender',['Male','Female']);
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
