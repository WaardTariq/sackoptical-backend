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
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('order_number')->unique();
            $table->string('status')->default('pending'); 
            // pending, confirmed, processing, out_for_delivery, delivered, returned, failed, canceled
            
            $table->string('payment_status')->default('unpaid');
            $table->string('payment_method')->nullable();
            
            $table->decimal('total', 10, 2);
            $table->decimal('tax', 10, 2)->default(0.00);
            $table->decimal('shipping_cost', 10, 2)->default(0.00);
            $table->decimal('discount', 10, 2)->default(0.00);
            
            $table->json('shipping_address')->nullable();
            $table->json('billing_address')->nullable();
            
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
