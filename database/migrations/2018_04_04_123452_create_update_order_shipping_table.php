<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpdateOrderShippingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->enum('shipping', ['dispute', 'ontheway', 'nearbyyou', 'delivered'])->nullable()->after('status');
            $table->dateTime('delivery_date')->nullable()->after('status');
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
            $table->dropColumn('shipping', ['dispute', 'ontheway', 'nearbyyou', 'delivered'])->nullable()->after('status');
            $table->dropColumn('delivery_date')->nullable()->after('status');
        });
    }
}
