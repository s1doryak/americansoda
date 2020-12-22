<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class DeleteExpiredStockProducts extends Migration
{
    public function up()
    {
        DB::transaction(function () {
            DB::unprepared('delete from stock_products where customer_order_item_id is null and expiration_date < now()');
        });
    }

    public function down()
    {
        //
    }
}
