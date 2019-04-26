<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned()->index()->nullable();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
            $table->string('title');
            $table->string('lang');
            $table->mediumText('text')->nullable();
            $table->string('image')->nullable();
            $table->integer('show_count')->default(0);
            $table->integer('order');
            $table->tinyInteger('status')->defaule(1);
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
        Schema::table('pages', function (Blueprint $table){
            $table->dropForeign(['author_id']);
        });
        Schema::dropIfExists('pages');
    }
}
