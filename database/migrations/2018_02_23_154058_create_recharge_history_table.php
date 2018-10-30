<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRechargeHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recharge_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('recharge_num');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('transaction_id')->unique();
            $table->integer('operator_id')->unsigned();
            $table->foreign('operator_id')->references('id')->on('operators')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('circle')->nullable();
            $table->double('amount')->nullable();
            $table->integer('res_trans_id')->nullable();
            $table->string('status')->nullable();
            $table->string('operator')->nullable();
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
        Schema::dropIfExists('recharge_history');
    }
}
