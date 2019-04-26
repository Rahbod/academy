<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned()->nullable()->index();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('parent_id')->unsigned()->index()->nullable();
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
            $table->text('content');
            $table->string('lang');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->tinyInteger('archive')->defaule(0);
            $table->tinyInteger('status')->defaule(0);
            $table->integer('like')->defaule(0);
            $table->integer('dis_like')->defaule(0);
            $table->integer('commentable_id');
            $table->string('commentable_type');
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
        Schema::table('comments', function (Blueprint $table){
            $table->dropForeign(['author_id']);
            $table->dropForeign(['parent_id']);
        });
        Schema::dropIfExists('comments');
    }
}
