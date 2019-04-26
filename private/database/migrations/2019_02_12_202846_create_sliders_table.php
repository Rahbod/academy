<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned()->index()->nullable();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('group_id')->unsigned()->index()->nullable();
            $table->foreign('group_id')->references('id')->on('slider_groups')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('lang')->default('fa');
            $table->text('text')->nullable();
            $table->string('link')->nullable();
            $table->string('image');
            $table->tinyInteger('status')->defaule(0);
            $table->integer('order')->defaule(0);
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
        Schema::table('sliders', function (Blueprint $table){
            $table->dropForeign(['author_id']);
            $table->dropForeign(['group_id']);
        });
        Schema::dropIfExists('sliders');
    }
}
