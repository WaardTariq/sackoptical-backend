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
        Schema::create('lens_coatings', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., Anti-Reflective
            $table->string('slug')->unique();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->decimal('tax_percentage', 5, 2)->default(8.25);
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lens_coatings');
    }
};
