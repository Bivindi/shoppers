<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderCancelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order', function (Blueprint $table) {
            $table->text('comments')->nullable()->after('shipping_charge');
            $table->string('reason')->nullable()->after('shipping_charge');
        });
        Schema::table('order', function (Blueprint $table) {
            $table->smallInteger('cancel_approve')->default(false)->after('comments');
            $table->smallInteger('return_approve')->default(false)->after('status');
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
            $table->dropColumn('comments')->nullable()->after('shipping_charge');
            $table->dropColumn('reason')->nullable()->after('shipping_charge');
        });
        Schema::table('order', function (Blueprint $table) {
            $table->dropColumn('cancel_approve')->default(false)->after('comments');
            $table->dropColumn('return_approve')->default(false)->after('status');
        });
    }
}
