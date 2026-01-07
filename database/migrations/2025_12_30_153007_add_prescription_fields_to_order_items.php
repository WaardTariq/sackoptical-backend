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
        Schema::table('order_items', function (Blueprint $table) {
            $table->string('prescription_file')->nullable()->after('prescription_data');
            $table->string('prescription_doctor')->nullable()->after('prescription_file');
            $table->string('prescription_date')->nullable()->after('prescription_doctor');
            $table->string('prescription_time')->nullable()->after('prescription_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn(['prescription_file', 'prescription_doctor', 'prescription_date', 'prescription_time']);
        });
    }
};
