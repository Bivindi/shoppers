<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->longText('desc');
            $table->string('m_title')->nullable();
            $table->text('m_desc')->nullable();
            $table->text('m_keywords')->nullable();
            $table->text('m_tag')->nullable();
            $table->string('model')->nullable();
            $table->string('sku')->nullable();
            $table->string('hsn')->nullable();
            $table->string('isbn')->nullable();
            $table->string('price')->nullable();
            $table->bigInteger('quantity')->nullable();
            $table->bigInteger('reward_points')->nullable();
            $table->integer('tax_class_id')->unsigned()->nullable();
            $table->foreign('tax_class_id')->references('id')->on('tax_class')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('brand_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('brands')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('sub_category_id')->unsigned();
            $table->foreign('sub_category_id')->references('id')->on('subcategories')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('status')->default(false);
            $table->string('product_img')->nullable();
            $table->bigInteger('order')->nullable();
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('products');
    }
}
