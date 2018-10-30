<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubcategories2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategories2', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subcategory_id')->unsigned();
            $table->foreign('subcategory_id')->references('id')->on('subcategories')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->string('desc');
            $table->string('sub_cat_img')->nullable();
            $table->string('slug');
            $table->string('commission')->nullable();
            $table->enum('commission_type', ['flat', 'percentage'])->nullable();
            $table->string('m_title')->nullable();
            $table->text('m_desc')->nullable();
            $table->text('m_keywords')->nullable();
            $table->text('m_tag')->nullable();
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
        Schema::dropIfExists('subcategories2');
    }
}
