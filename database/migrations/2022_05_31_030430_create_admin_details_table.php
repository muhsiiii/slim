<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('is_superadmin')->nullable()->default(0);
            $table->string('name', 100)->nullable()->default('admin');
            $table->string('username', 100)->nullable()->default('admin');
            $table->string('password', 100)->nullable()->default('admin');
            $table->rememberToken();
            $table->bigInteger('mobile')->nullable()->default(0);
            $table->string('mail_id', 100)->nullable()->default('admin@gmail.com');
            $table->string('facebook', 100)->nullable()->default('0');
            $table->string('instagram', 100)->nullable()->default('0');
            $table->string('twitter', 100)->nullable()->default('0');
            $table->string('profile_image', 100)->nullable()->default('image');
            $table->bigInteger('status')->nullable();
            $table->string('description', 500)->nullable();
            $table->timestamps();
        });

        DB::table('admin_details')->insert([

            'name'=>'admin',
            'username'=>'admin',
            'password'=>bcrypt('admin'),

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_details');
    }
};
