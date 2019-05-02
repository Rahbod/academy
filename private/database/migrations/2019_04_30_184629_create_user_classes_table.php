<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('class_room_id')->unsigned()->index()->nullable();
            $table->foreign('class_room_id')->references('id')->on('class_rooms')->onDelete('set null');
            $table->tinyInteger('status')->defaule(1);
            $table->timestamps();

            $table->unique('user_id', 'class_room_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_classes', function (Blueprint $table){
            $table->dropForeign(['user_id']);
            $table->dropForeign(['class_room_id']);
        });
        Schema::dropIfExists('user_classes');
    }
}
