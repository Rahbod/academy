<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGatewayTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gateway_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);
            $table->enum('port', [
                'MELLAT',
                'SADAD',
                'ZARINPAL',
                'PAYLINE',
                'JAHANPAY',
                'PARSIAN',
                'PASARGAD',
                'SAMAN',
                'ASANPARDAKHT',
                'PAYPAL',
                'PAYIR',
            ]);
            $table->decimal('price', 15, 2);
            $table->string('ref_id', 100)->nullable();
            $table->string('tracking_code', 50)->nullable();
            $table->string('card_number', 50)->nullable();
            $table->enum('status', [
                'INIT',
                'SUCCEED',
                'FAILED',
            ])->default('INIT');
            $table->string('ip', 20)->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gateway_transactions');
    }
}
