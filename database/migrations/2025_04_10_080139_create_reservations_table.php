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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('UserID');
            $table->unsignedBigInteger('BaanID');
            $table->date('Data');
            $table->time('Starttime');
            $table->time('Endtime');
            $table->unsignedTinyInteger('Aantal_personen')->default(1);
            $table->string('Status', 50)->default('Bevestigd');
            $table->decimal('Kosten', 8, 2)->nullable();
            $table->boolean('Betaald')->default(0);
            $table->text('Opmerking')->nullable();
            $table->timestamps();

            $table->foreign('UserID')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('BaanID')->references('id')->on('baan')->onDelete('cascade');
        });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
