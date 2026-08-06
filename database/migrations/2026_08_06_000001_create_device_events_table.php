<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('device_events', function (Blueprint $table) {

            $table->id();

            $table->string('device_id')->index();

            $table->string('serial_number')->index();

            $table->string('event',50);

            $table->string('old_value')->nullable();

            $table->string('new_value')->nullable();

            $table->text('message')->nullable();

            $table->timestamp('created_at');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('device_events');
    }
};