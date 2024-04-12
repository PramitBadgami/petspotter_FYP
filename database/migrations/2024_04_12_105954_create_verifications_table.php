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
        Schema::create('verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('age');
            $table->timestamp('DOB')->nullable();
            $table->string('city');
            $table->enum('province',['Koshi','Madhesh', 'Bagmati', 'Gandaki', 'Lumbini','Karnali','Sudurpashchim']);
            $table->string('zip');
            $table->text('address');
            $table->string('mobile');
            $table->enum('document_type',['Citizenship','Passport','Licebse']);
            $table->string('father_spouse')->nullable();
            $table->text('notes');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifications');
    }
};
