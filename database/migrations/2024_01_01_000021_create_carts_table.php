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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('session_id')->nullable()->index(); // For guest carts
            $table->timestamps();
        });

        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained('carts')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            
            // Optical Add-ons for Cart
            $table->foreignId('lens_type_id')->nullable()->constrained('lens_types')->onDelete('set null');
            $table->foreignId('lens_coating_id')->nullable()->constrained('lens_coatings')->onDelete('set null');
            
            // Note: Prescription is usually attached at Checkout/Order level, but could be here if needed.
            // Keeping it simple for now, can be added to data json if specific per item.
            $table->json('attributes')->nullable(); // For frame color/size selected

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('carts');
    }
};
