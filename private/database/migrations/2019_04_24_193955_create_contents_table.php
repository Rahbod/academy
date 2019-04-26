<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned()->index()->nullable();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('category_id')->unsigned()->index()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->string('title');
            $table->string('lang');
            $table->string('type');
            $table->text('summary')->nullable();
            $table->mediumText('text')->nullable();
            $table->string('logo')->nullable();
            $table->string('image')->nullable();
            $table->string('source')->nullable();
            $table->string('source_link')->nullable();
            $table->integer('show_count')->default(0);
            $table->integer('order');
            $table->tinyInteger('status')->defaule(1);
            $table->timestamp('published_at')->nullable();
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
        Schema::table('contents', function (Blueprint $table){
            $table->dropForeign(['author_id']);
            $table->dropForeign(['category_id']);
        });
        Schema::dropIfExists('contents');
    }
}
