<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomepageProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('new_arrival')->default(false)->after('slug');
            $table->boolean('special')->default(false)->after('slug');
            $table->boolean('recommend')->default(false)->after('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('new_arrival')->default(false)->after('slug');
            $table->dropColumn('special')->default(false)->after('slug');
            $table->dropColumn('recommend')->default(false)->after('slug');
        });
    }
}
