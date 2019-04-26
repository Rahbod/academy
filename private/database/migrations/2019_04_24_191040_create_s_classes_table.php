<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned()->index()->nullable();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('teacher_id')->unsigned()->index()->nullable();
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('course_id')->unsigned()->index()->nullable();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('set null');
            $table->string('lang');
            $table->string('title_fa');
            $table->string('title_en');
            $table->text('description_fa');
            $table->text('description_en');
            $table->string('image');
            $table->timestamp('registration_start_date')->nullable();
            $table->timestamp('registration_end_date')->nullable();
            $table->timestamp('course_start_date')->nullable();
            $table->timestamp('course_end_date')->nullable();
            $table->smallInteger('capacity')->nullable();
            $table->string('price');
            $table->tinyInteger('status');
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
        Schema::table('class_rooms', function (Blueprint $table){
            $table->dropForeign(['teacher_id']);
            $table->dropForeign(['author_id']);
            $table->dropForeign(['course_id']);
        });
        Schema::dropIfExists('class_rooms');
    }
}
