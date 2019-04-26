<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id')->unsigned()->index();
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->integer('parent_id')->unsigned()->index()->nullable();
            $table->foreign('parent_id')->references('id')->on('menu_items')->onDelete('set null');
            $table->integer('_lft')->nullable();
            $table->integer('_rgt')->nullable();
            $table->integer('path_id')->unsigned()->index()->nullable();
            $table->foreign('path_id')->references('id')->on('paths')->onDelete('cascade');
            $table->string('name');
            $table->string('display_name');
            $table->string('url')->nullable();
            $table->string('icon')->nullable();
            $table->integer('order');
            $table->string('target');
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_items', function (Blueprint $table){
            $table->dropForeign(['menu_id']);
            $table->dropForeign(['path_id']);
            $table->dropForeign(['parent_id']);
        });
        Schema::dropIfExists('menu_items');
    }
}
