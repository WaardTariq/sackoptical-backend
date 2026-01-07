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
        Schema::table('lens_types', function (Blueprint $table) {
            $table->string('image')->nullable()->after('slug');
            $table->dropColumn('tax_percentage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lens_types', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->decimal('tax_percentage', 8, 2)->nullable()->after('price_modifier');
        });
    }
};
