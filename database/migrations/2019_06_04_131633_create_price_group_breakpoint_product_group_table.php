<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreatePriceGroupBreakpointproductGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_group_breakpoint_product_group', function (Blueprint $table) {
            $table->fks([
                'price_group_breakpoint_id',
                'product_group_id'
            ], 'cascade', true);
			$table->float('price')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_group_breakpoint_product_group');
    }
}
