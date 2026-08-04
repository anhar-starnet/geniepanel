<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration
     */
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {

            $table->enum('service_type', [
                'PPPOE',
                'STATIC',
                'HOTSPOT',
            ])
            ->default('PPPOE')
            ->after('ont_id');

        });
    }

    /**
     * Rollback migration
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {

            $table->dropColumn('service_type');

        });
    }
};