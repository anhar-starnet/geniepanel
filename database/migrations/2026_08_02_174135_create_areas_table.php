<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('areas', function (Blueprint $table) {

            $table->id();

            $table->string('code',20)->unique();

            $table->string('name',100);

            $table->string('pic',100)->nullable();

            $table->string('phone',30)->nullable();

            $table->text('address')->nullable();

            $table->decimal('latitude',10,7)->nullable();

            $table->decimal('longitude',10,7)->nullable();

            $table->boolean('status')->default(true);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('areas');
    }
};