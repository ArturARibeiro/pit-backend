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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('sku')->unique();
            $table->string('name');
            $table->string('picture')->nullable();
            $table->decimal('base_price', 10);
            $table->decimal('promotion_price', 10)->nullable();
            $table->text('description');
            $table->float('rating')->unsigned();
            $table->enum('unit', ['uni', 'kg', 'g']);
            $table->unsignedInteger('order_count');
            $table->float('quantity_gap')->unsigned();
            $table->json('tags');
            $table->timestamps();
        });

        Schema::create('product_product_category', function (Blueprint $table) {
            $table->foreignUuid('product_id')->constrained();
            $table->foreignUuid('product_category_id')->constrained();
            $table->primary(['product_id', 'product_category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_category_product');
        Schema::dropIfExists('products');
    }
};
