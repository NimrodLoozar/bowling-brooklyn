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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('lane_id')->constrained('lanes')->onDelete('cascade');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->unsignedTinyInteger('number_of_people')->default(1);
            $table->string('status', 50)->default('confirmed');
            $table->decimal('cost', 8, 2)->nullable();
            $table->boolean('paid')->default(false);
            $table->text('note')->nullable();
            $table->timestamps();
        });

        Schema::create('reservation_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained('reservations')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->integer('score')->default(0);
            $table->unsignedInteger('round')->default(1)->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->text('comment', 255)->nullable();
            $table->tinyInteger('validated', false, true)->default(0);
            $table->string('player_name', 100)->nullable();
            $table->string('team_name', 100)->nullable();
            $table->string('name', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_participants');
        Schema::dropIfExists('reservations');
    }
};
