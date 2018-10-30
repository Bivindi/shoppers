<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentCollectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_collection', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fee_deduction_id')->unsigned();
            $table->foreign('fee_deduction_id')->references('id')->on('fee_deduction')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->double('selling_fee');
            $table->double('closing_fee');
            $table->double('total_fee');
            $table->double('service_tax');
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
        Schema::dropIfExists('payment_collection');
    }
}
