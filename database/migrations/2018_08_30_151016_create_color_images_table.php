<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('color_images', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('product_id')->unsigned();
        //     $table->integer('attribute_id')->unsigned();
        //     $table->foreign('attribute_id')->references('id')->on('product_attributes')
        //         ->onUpdate('cascade')->onDelete('cascade');
        //     $table->string('images')->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('color_images');
    }
}
