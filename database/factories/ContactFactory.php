<?php

namespace Database\Factories;

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
        Schema::create('contacts', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('user_id')->nullable()->comment('Persoon_ID');
            $table->string('email', 255);
            $table->string('telefoon', 20)->nullable();
            $table->string('mobiel', 20)->nullable();
            $table->string('adres', 255)->nullable();
            $table->string('postcode', 10)->nullable();
            $table->string('plaats', 100)->nullable();
            $table->string('land', 100)->nullable();
            $table->text('notitie')->nullable();
            $table->dateTime('aanmaakdatum', 6);
            $table->dateTime('bewerkingsdatum', 6);
            
            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users');
            
            // Timestamps
            $table->timestamps(); // Optional: Laravel's default created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};