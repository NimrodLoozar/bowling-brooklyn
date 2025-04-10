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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primaire sleutel, Auto Increment
            $table->unsignedBigInteger('user_id'); // Foreign key naar User tabel
            $table->json('product')->nullable(); // Store product as JSON
            $table->json('sub_product')->nullable(); // Store sub_product as JSON
            $table->timestamp('besteldatum')->default(DB::raw('CURRENT_TIMESTAMP')); // Default: current_timestamp
            $table->string('status', 50)->default('Nieuw'); // Default: 'Nieuw'
            $table->decimal('totaalbedrag', 10, 2)->default(0.00); // Default: 0.00
            $table->string('betaalmethode', 50)->nullable(); // Nullable
            $table->string('betaalstatus', 20)->default('Niet betaald'); // Default: 'Niet betaald'
            $table->unsignedInteger('aantal'); // Niet nullable
            $table->text('opmerking')->nullable(); // Nullable
            $table->timestamps(); // Adds created_at and updated_at columns
            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
