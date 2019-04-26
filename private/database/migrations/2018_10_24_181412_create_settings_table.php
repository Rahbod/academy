<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('setting_group_id')->unsigned()->index();
            $table->foreign('setting_group_id')->references('id')->on('setting_groups')->onDelete('cascade');
            $table->string('name');
            $table->string('display_name');
            $table->text('value');
            $table->text('details')->nullable();
            $table->string('type');
            $table->enum('direction', ['inherit', 'rtl','ltr'])->default('inherit');
            $table->integer('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table){
            $table->dropForeign(['setting_group_id']);
        });
        Schema::dropIfExists('settings');
    }
}
