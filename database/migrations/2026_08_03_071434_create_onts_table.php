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
        Schema::create('onts', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relasi
            |--------------------------------------------------------------------------
            */

            $table->foreignId('splitter_port_id')
    ->nullable()
    ->constrained()
    ->cascadeOnUpdate()
    ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Identitas ONT
            |--------------------------------------------------------------------------
            */

            $table->string('code')->unique();

            $table->string('vendor');

            $table->string('model');

            $table->string('serial_number')->unique();

            $table->string('firmware')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Integrasi GenieACS
            |--------------------------------------------------------------------------
            */

            $table->string('genieacs_device_id')
                ->nullable()
                ->unique();

            /*
            |--------------------------------------------------------------------------
            | Informasi
            |--------------------------------------------------------------------------
            */

            $table->boolean('status')
                ->default(true);

            $table->text('notes')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('onts');
    }
};