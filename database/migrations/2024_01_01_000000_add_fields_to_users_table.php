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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('image')->nullable()->after('phone');
            $table->string('status')->default('active')->after('password'); // active, blocked
            $table->integer('total_orders')->default(0)->after('status');
            $table->decimal('total_spend', 10, 2)->default(0.00)->after('total_orders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'image', 'status', 'total_orders', 'total_spend']);
        });
    }
};
