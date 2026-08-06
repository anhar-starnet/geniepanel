<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('device_events', function (Blueprint $table) {

            $table->string('pppoe_username')
                ->nullable()
                ->after('serial_number');

            $table->string('reason')
                ->nullable()
                ->after('event');

            $table->unsignedTinyInteger('confidence')
                ->default(0)
                ->after('reason');

            $table->string('severity')
                ->default('info')
                ->after('confidence');

        });
    }

    public function down(): void
    {
        Schema::table('device_events', function (Blueprint $table) {

            $table->dropColumn([
                'pppoe_username',
                'reason',
                'confidence',
                'severity'
            ]);

        });
    }
};