<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('transaction_id')->unique();
            $table->integer('operator_id')->unsigned();
            $table->foreign('operator_id')->references('id')->on('operators')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('mobile_num')->nullable();
            $table->double('amount')->nullable();
            $table->double('previous_balance')->nullable();
            $table->double('next_balance')->nullable();
            $table->string('offer_code')->nullable();
            $table->string('account_number')->nullable();
            $table->enum('application_type', ['web', 'app']);
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('transaction');
    }
}
