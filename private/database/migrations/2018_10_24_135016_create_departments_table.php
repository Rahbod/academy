<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('namespace_id')->unsigned()->index();
            $table->foreign('namespace_id')->references('id')->on('sp_namespaces')->onDelete('cascade');
            $table->string('name');
            $table->string('display_name');
            $table->string('prefix')->nullable();
            $table->string('middleware')->nullable();
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
        Schema::table('departments', function (Blueprint $table) {
            $table->dropForeign(['namespace_id']);
        });
        Schema::dropIfExists('departments');
    }
}
