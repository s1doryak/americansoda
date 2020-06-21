<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class DropUserIdFromCustomerOrdersCustomerShipmentsTables extends Migration
{
    public function up()
    {
        Schema::table('customer_orders', function (Blueprint $table) {
            $table->dropForeign('customer_orders_user_id_foreign');
            $table->dropColumn('user_id');
        });

        Schema::table('customer_shipments', function (Blueprint $table) {
            $table->dropForeign('customer_shipments_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }

    public function down()
    {
        Schema::table('customer_orders', function (Blueprint $table) {
            $table->fks([
                'user_id',
            ], 'set null', true);
        });

        Schema::table('customer_shipment', function (Blueprint $table) {
            $table->fks([
                'user_id',
            ], 'set null', true);
        });
    }
}
