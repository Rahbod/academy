<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translate_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned()->index()->nullable();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('category_id')->unsigned()->index()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->string('title');
            $table->string('translation_language');
            $table->string('description');
            $table->enum('status', ['INIT', 'REJECTED', 'TRANSLATED',])->default('INIT');
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
        Schema::table('translate_requests', function (Blueprint $table){
            $table->dropForeign(['author_id']);
            $table->dropForeign(['category_id']);
        });
        Schema::dropIfExists('translate_requests');
    }
}
