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
        Schema::create('odps', function (Blueprint $table) {

            $table->id();

            $table->foreignId('pop_id')
                ->constrained('pops')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('code', 20)->unique();

            $table->string('name', 100);

            $table->string('distribution_type', 20)
                ->default('AERIAL');

            $table->integer('port_capacity')
                ->default(16);

            $table->integer('used_ports')
                ->default(0);

            $table->string('fiber_core', 20)
                ->nullable();

            $table->text('address')
                ->nullable();

            $table->decimal('latitude', 10, 7)
                ->nullable();

            $table->decimal('longitude', 10, 7)
                ->nullable();

            $table->text('description')
                ->nullable();

            $table->boolean('status')
                ->default(true);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('odps');
    }
};