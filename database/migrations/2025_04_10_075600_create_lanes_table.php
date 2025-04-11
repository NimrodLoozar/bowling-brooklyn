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
        Schema::create('lanes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('type', 50);
            $table->string('location', 255)->nullable();
            $table->unsignedInteger('capacity')->default(1);
            $table->string('status', 50)->default('Beschikbaar');
            $table->decimal('prijs_per_uur', 8, 2);
            $table->text('note')->nullable();
            $table->tinyInteger('actief')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lanes');
    }
};
