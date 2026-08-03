<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pops', function (Blueprint $table) {

            $table->id();

            $table->foreignId('area_id')
                ->constrained('areas')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('code',20)->unique();

            $table->string('name',100);

            $table->string('mikrotik_name',100)->nullable();

            $table->string('olt_name',100)->nullable();

            $table->string('ip_address',45)->nullable();

            $table->text('address')->nullable();

            $table->decimal('latitude',10,7)->nullable();

            $table->decimal('longitude',10,7)->nullable();

            $table->text('description')->nullable();

            $table->boolean('status')->default(true);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pops');
    }
};