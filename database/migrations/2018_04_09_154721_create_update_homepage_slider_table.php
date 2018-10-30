<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpdateHomepageSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('homepage_slider', function (Blueprint $table) {
            $table->string('url')->nullable()->after('footer_slider');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('homepage_slider', function (Blueprint $table) {
            $table->dropColumn('url')->nullable()->after('footer_slider');
        });
    }
}
