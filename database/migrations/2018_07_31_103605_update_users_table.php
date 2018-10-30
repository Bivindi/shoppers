<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('company_name')->nullable()->after('state');
            $table->string('shipping_address')->nullable()->after('company_name');
            $table->double('pincode')->nullable()->after('shipping_address');
            $table->string('benificiary_name')->nullable()->after('pincode');
            $table->double('account_number')->nullable()->after('benificiary_name');
            $table->double('ifsc_code')->nullable()->after('account_number');
            $table->string('bank_name')->nullable()->after('ifsc_code');
            $table->string('branch_name')->nullable()->after('bank_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
