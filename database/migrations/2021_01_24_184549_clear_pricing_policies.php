<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class ClearPricingPolicies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('DELETE FROM customer_pricing_policies WHERE deleted_at IS NOT NULL');
        DB::statement('DELETE FROM customer_pricing_policies WHERE products_range = 0 AND price = 0');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
