<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomepageSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homepage_slider', function (Blueprint $table) {
            $table->increments('id');
            $table->string('main_slider')->nullable();
            $table->string('small_slider')->nullable();
            $table->string('medium_slider')->nullable();
            $table->string('new_arrival_slider')->nullable();
            $table->string('top_seller_slider')->nullable();
            $table->string('seller_horizontal_slider')->nullable();
            $table->string('special_product_slider')->nullable();
            $table->string('recommend_slider')->nullable();
            $table->string('footer_slider')->nullable();
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
        Schema::dropIfExists('homepage_slider');
    }
}
