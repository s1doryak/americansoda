<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AddCustomerShipmentIdColumnToLtpTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ltp_transfers', function (Blueprint $table) {
            $table->fk([
               'column' => 'customer_shipment_id',
               'table' => 'customer_shipment'
            ], 'cascade', true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ltp_transfers', function (Blueprint $table) {
            $table->dropColumn('customer_shipment_id');
        });
    }
}
