<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('transaction_id')->index()->nullable();
            $table->foreign('transaction_id')->references('id')->on('gateway_transactions')->onDelete('set null');
            $table->integer('user_class_id')->unsigned()->index()->nullable();
            $table->foreign('user_class_id')->references('id')->on('user_classes')->onDelete('set null');
            $table->integer('translate_request_id')->unsigned()->index()->nullable();
            $table->foreign('translate_request_id')->references('id')->on('translate_requests')->onDelete('set null');
            $table->string('description')->nullable();
            $table->enum('type', ['CRASH', 'GATEWAY'])->default('CRASH');
            $table->enum('status', ['INIT', 'SUCCEED', 'FAILED',])->default('INIT');

            $table->string('price');
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
        Schema::table('user_transactions', function (Blueprint $table){
            $table->dropForeign(['user_class_id']);
            $table->dropForeign(['translate_request_id']);
        });
        Schema::dropIfExists('user_transactions');
    }
}
