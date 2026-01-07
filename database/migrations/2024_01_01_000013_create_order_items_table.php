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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('set null');
            $table->string('product_name');
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2);
            
            // Tax Snapshots
            $table->decimal('tax_amount', 10, 2)->default(0.00);
            $table->decimal('tax_rate', 5, 2)->default(0.00);

            // Optical Add-ons (Nullable)
            $table->foreignId('lens_type_id')->nullable()->constrained('lens_types')->onDelete('set null');
            $table->foreignId('lens_coating_id')->nullable()->constrained('lens_coatings')->onDelete('set null');
            
            $table->json('prescription_data')->nullable(); // Snapshot of prescription used

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
