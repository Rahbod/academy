<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->enum('type',['admin','operator','teacher']);
            $table->tinyInteger('is_admin')->default(0);
            $table->boolean('status')->defaule(0);
            $table->boolean('verified')->defaule(0);
            $table->string('verify_email_link')->nullable();
            $table->tinyInteger('access_level')->defalut(0);
            $table->enum('provider',['google','facebook','twitter','github','linkedin'])->nullable();
            $table->bigInteger('provider_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
