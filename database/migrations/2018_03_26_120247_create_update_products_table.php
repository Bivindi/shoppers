<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpdateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('url')->nullable()->after('reward_points');
            $table->string('video_id')->nullable()->after('reward_points');
            $table->string('video_thumb')->nullable()->after('reward_points');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('url')->nullable()->after('reward_points');
            $table->dropColumn('video_id')->nullable()->after('reward_points');
            $table->dropColumn('video_thumb')->nullable()->after('reward_points');
        });
    }
}
