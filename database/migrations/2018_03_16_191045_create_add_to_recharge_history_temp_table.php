<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddToRechargeHistoryTempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recharge_history', function (Blueprint $table) {
            $table->string('recharge_temp_id')->nullable()->after('transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recharge_history', function (Blueprint $table) {
            $table->dropColumn('recharge_temp_id')->nullable()->after('transaction_id');
        });
    }
}
