<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('pan_or_tan_num')->nullable()->after('kyc_status');
            $table->string('gst_num')->nullable()->after('kyc_status');
            $table->string('aadhar_front')->nullable()->after('kyc_status');
            $table->string('aadhar_back')->nullable()->after('kyc_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('pan_or_tan_num')->nullable()->after('kyc_status');
            $table->dropColumn('gst_num')->nullable()->after('kyc_status');
            $table->dropColumn('aadhar_front')->nullable()->after('kyc_status');
            $table->dropColumn('aadhar_back')->nullable()->after('kyc_status');
        });
    }
}
