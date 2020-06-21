<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetUtf8mb4CustomerOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $query = "ALTER TABLE customer_orders CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";
        DB::statement($query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $query = "ALTER TABLE customer_orders CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;";
        DB::statement($query);
    }
}
