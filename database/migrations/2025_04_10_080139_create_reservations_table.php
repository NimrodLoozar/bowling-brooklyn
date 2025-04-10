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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('baan_id');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->unsignedTinyInteger('number_of_people')->default(1);
            $table->string('status', 50)->default('confirmed');
            $table->decimal('cost', 8, 2)->nullable();
            $table->boolean('paid')->default(false);
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('baan_id')->references('id')->on('baan')->onDelete('cascade');
        });
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
