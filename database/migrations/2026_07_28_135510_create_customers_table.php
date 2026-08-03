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
    Schema::create('customers', function (Blueprint $table) {

        $table->id();

        $table->string('customer_code',20)->unique();

        $table->string('name');

        $table->string('nik',30)->nullable();

        $table->string('phone',30)->nullable();

        $table->string('email')->nullable();

        $table->text('address')->nullable();

        $table->decimal('latitude',10,7)->nullable();

        $table->decimal('longitude',10,7)->nullable();

        $table->unsignedBigInteger('package_id')->nullable();

        $table->unsignedBigInteger('pop_id')->nullable();

        $table->unsignedBigInteger('odp_id')->nullable();

        $table->unsignedBigInteger('ont_id')->nullable();

        $table->string('pppoe_username')->nullable();

        $table->string('pppoe_password')->nullable();

        $table->string('serial_number')->nullable();

        $table->enum('status',[
            'active',
            'suspend',
            'terminated'
        ])->default('active');

        $table->timestamps();

    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
