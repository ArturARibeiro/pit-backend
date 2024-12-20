<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->constrained();
            $table->foreignUuid('address_id')->constrained();
            $table->foreignUuid('card_id')->constrained();
            $table->enum('status', ['pending', 'preparing', 'transport', 'concluded', 'canceled']);
            $table->unsignedTinyInteger('rate')->nullable();
            $table->text('review')->nullable();
            $table->timestamp('date');
            $table->timestamps();
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
