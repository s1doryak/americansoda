<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class UpdateCustomerInvoiceItemsTable1b41c2d80 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_invoice_items', function (Blueprint $table) {
			$table->fk([
				'column' => 'product_id',
				'table' => 'products',
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
        //
    }
}
