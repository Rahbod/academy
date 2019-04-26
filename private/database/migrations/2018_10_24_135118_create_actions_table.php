<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('resource_id')->unsigned()->index();
            $table->foreign('resource_id')->references('id')->on('resources')->onDelete('cascade');
            $table->string('resource_name');
            $table->string('name');
            $table->string('display_name');
            $table->enum('type', ['general', 'page_loader','frame_loader'])->default('general');
            $table->tinyInteger('need_allow')->default(0);
            $table->tinyInteger('status')->default(1);
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
        Schema::table('actions', function (Blueprint $table) {
            $table->dropForeign(['resource_id']);
        });
        Schema::dropIfExists('actions');
    }
}
