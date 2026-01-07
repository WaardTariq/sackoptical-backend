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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->string('variant_name'); // e.g., "Design: Sd, Size: Large"
            $table->json('attribute_values'); // Store attribute-value pairs as JSON
            $table->decimal('price', 10, 2); // Variant-specific price
            $table->integer('stock')->default(0); // Variant-specific stock
            $table->string('sku')->nullable(); // Variant SKU
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
