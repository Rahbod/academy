<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
//            $table->increments('id');
//            $table->integer('receiver_id')->unsigned()->index();
//            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
//            $table->integer('subject_id')->nullable();
//            $table->string('subject_type')->nullable();
//            $table->integer('causer_id')->nullable();
//            $table->string('causer_type')->nullable();
//            $table->string('title');
//            $table->text('description');
//            $table->boolean('seen')->default(false);
//            $table->timestamps();

            $table->uuid('id')->primary();
            $table->string('type');
            $table->morphs('notifiable');
            $table->text('data');
            $table->timestamp('read_at')->nullable();
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
        Schema::dropIfExists('notifications');
    }
}
