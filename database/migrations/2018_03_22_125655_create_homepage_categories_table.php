<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomepageCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->boolean('new_arrival')->default(false)->after('cat_img');
            $table->boolean('top_seller')->default(false)->after('cat_img');
            $table->boolean('special')->default(false)->after('cat_img');
            $table->boolean('recommend')->default(false)->after('cat_img');
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
            $table->dropColumn('new_arrival')->default(false)->after('cat_img');
            $table->dropColumn('top_seller')->default(false)->after('cat_img');
            $table->dropColumn('special')->default(false)->after('cat_img');
            $table->dropColumn('recommend')->default(false)->after('cat_img');
        });
    }
}
