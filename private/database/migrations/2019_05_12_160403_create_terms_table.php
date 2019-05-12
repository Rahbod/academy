<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned()->index()->nullable();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('course_id')->unsigned()->index();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->string('lang');
            $table->string('title_fa');
            $table->string('title_en');
            $table->integer('order');
            $table->tinyInteger('status');
            $table->text('description_fa')->nullable();
            $table->text('description_en')->nullable();
            $table->timestamps();
        });

        Schema::table('class_rooms', function (Blueprint $table) {
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
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
            $table->dropForeign(['term_id']);
        });
        Schema::table('terms', function (Blueprint $table){
            $table->dropForeign(['course_id']);
            $table->dropForeign(['author_id']);
        });
        Schema::dropIfExists('terms');
    }
}
