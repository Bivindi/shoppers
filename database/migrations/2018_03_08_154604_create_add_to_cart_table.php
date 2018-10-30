<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddToCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart', function (Blueprint $table) {
            $table->string('color')->nullable()->after('cart_temp_id');
        });
        Schema::table('cart', function (Blueprint $table) {
            $table->string('quantity')->nullable()->after('color');
        });
        Schema::table('cart', function (Blueprint $table) {
            $table->string('size')->nullable()->after('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart', function (Blueprint $table) {
            $table->dropColumn('color');
            $table->dropColumn('quantity');
            $table->dropColumn('size');
        });
    }
}
