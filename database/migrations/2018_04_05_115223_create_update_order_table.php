<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpdateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->string('payment_type')->nullable()->after('shipping_method');
        });
        Schema::table('order', function (Blueprint $table) {
            $table->double('shipping_charge')->nullable()->after('payment_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->dropColumn('payment_type')->nullable()->after('shipping_method');
        });
        Schema::table('order', function (Blueprint $table) {
            $table->dropColumn('shipping_charge')->nullable()->after('payment_type');
        });
    }
}
