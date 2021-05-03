<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AddPickedAndCustomerOrderItemIdColumnsToLtpTransferItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ltp_transfer_items', function (Blueprint $table) {
            $table->integer('picked')->nullable();

            $table->fk([
                'column' => 'customer_order_item_id',
                'table' => 'customer_order_items',
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
        Schema::table('ltp_transfer_items', function (Blueprint $table) {
            $table->dropColumn('picked');
            $table->dropColumn('customer_order_item_id');
        });
    }
}
