<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassRoomTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_room_times', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned()->index()->nullable();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('class_room_id')->unsigned()->index();
            $table->foreign('class_room_id')->references('id')->on('class_rooms')->onDelete('cascade');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('week_day',['saturday','sunday','monday','tuesday','wednesday','thursday','friday']);
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
        Schema::table('class_room_times', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropForeign(['class_room_id']);
        });
        Schema::dropIfExists('class_room_times');
    }
}
