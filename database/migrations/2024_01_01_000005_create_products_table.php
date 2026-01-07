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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('sub_category_id')->nullable()->constrained('sub_categories')->onDelete('set null');
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('set null');
            
            // Pricing
            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->decimal('tax_percentage', 5, 2)->default(8.25);
            $table->integer('stock')->default(0);
            $table->text('description')->nullable();

            // Measurements - Critical for Optical
            $table->string('lens_width')->nullable();
            $table->string('bridge_width')->nullable();
            $table->string('temple_length')->nullable();
            $table->string('frame_width')->nullable();
            $table->string('face_width_recommended')->nullable();

            // Details
            $table->string('frame_shape')->nullable();
            $table->string('material')->nullable();
            $table->string('front_color')->nullable();
            $table->string('lens_color')->nullable();
            $table->string('size')->nullable(); // Small, Standard, Large

            $table->boolean('is_featured')->default(false);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
