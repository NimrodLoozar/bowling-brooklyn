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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('participant_id')->constrained('reservation_participants')->onDelete('cascade');
            $table->integer('score')->default(0);
            $table->string('player_name', 100)->nullable();
            $table->unsignedInteger('round')->default(1)->nullable();
            $table->date('date');
            $table->time('time')->nullable();
            $table->text('comment', 255)->nullable();
            $table->tinyInteger('validated', false, true)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
