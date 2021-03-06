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
            $table->integer('paymentable_id')->unsigned();
            $table->string('paymentable_type');
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
        Schema::table('user_transactions', function (Blueprint $table) {
            $table->dropForeign(['transaction_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('user_transactions');
    }
}
