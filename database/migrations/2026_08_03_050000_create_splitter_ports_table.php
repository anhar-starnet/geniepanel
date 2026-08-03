<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('splitter_ports', function (Blueprint $table) {

            $table->id();

            $table->foreignId('splitter_id')
                ->constrained('splitters')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unsignedSmallInteger('port_number');

            $table->enum('status', [

                'FREE',

                'USED',

                'RESERVED',

                'BROKEN',

            ])->default('FREE');

            $table->unsignedBigInteger('ont_id')
                ->nullable();

            $table->timestamps();

            $table->unique([
                'splitter_id',
                'port_number',
            ]);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('splitter_ports');
    }
};