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
        Schema::create('product_customization_options', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('product_customization_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->decimal('price_modifier', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_customization_options');
    }
};
