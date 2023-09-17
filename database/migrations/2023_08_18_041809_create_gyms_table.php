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
        Schema::create('gyms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('agent_id',10)->nullable();
            $table->string('name',100)->nullable();
            $table->string('pincode',20)->nullable();
            $table->string('state',60)->nullable();
            $table->string('district',60)->nullable();
            $table->string('area',200)->nullable();
            $table->string('address',700)->nullable();
            $table->string('propriter',100)->nullable();
            $table->string('mobile',20)->nullable();
            $table->string('password',150)->nullable();
            $table->string('mail_id',150)->nullable();
            $table->integer('plan')->nullable();
            $table->string('fee',10)->nullable();
            $table->date('validfrom')->nullable();
            $table->date('validto')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gyms');
    }
};
