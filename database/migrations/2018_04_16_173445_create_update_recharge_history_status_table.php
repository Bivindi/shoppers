<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpdateRechargeHistoryStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recharge_history', function (Blueprint $table) {
            $table->enum('payment_status', ['Success', 'Failure', 'Aborted', 'Invalid'])->nullable()->after('status');
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
            $table->dropColumn('payment_status', ['Success', 'Failure', 'Aborted', 'Invalid'])->nullable()->after('status');
        });
    }
}
