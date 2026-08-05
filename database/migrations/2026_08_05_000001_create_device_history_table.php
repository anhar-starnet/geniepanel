<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run migrations.
     */
    public function up(): void
    {
        Schema::create('device_history', function (Blueprint $table) {

            $table->id();

            $table->string('device_id')->index();

            $table->string('serial_number')->index();

            $table->string('manufacturer')->nullable();

            $table->string('product_class')->nullable();

            $table->boolean('online')->default(false);

            $table->string('rx_power')->nullable();

            $table->string('temperature')->nullable();

            $table->string('uptime')->nullable();

            $table->string('pppoe_username')->nullable();

            $table->string('pppoe_ip')->nullable();

            $table->timestamp('last_inform')->nullable();

            $table->timestamps();

            $table->index('created_at');

            $table->index([
                'serial_number',
                'created_at'
            ]);

        });
    }

    /**
     * Reverse migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_history');
    }
};