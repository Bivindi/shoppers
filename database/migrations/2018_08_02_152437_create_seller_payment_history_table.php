<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellerPaymentHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_payment_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seller_payment_id')->unsigned();
            $table->foreign('seller_payment_id')->references('id')->on('seller_payment_request')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->double('amount')->nullable();
            $table->integer('payment_status')->unsigned();
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
        Schema::dropIfExists('seller_payment_history');
    }
}
