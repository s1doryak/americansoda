<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_invoice_items', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->fk([
				'column' => 'invoice_id',
				'table' => 'customer_invoices',
			], 'cascade', true);
			$table->fk([
				'column' => 'order_item_id',
				'table' => 'customer_order_items',
			], 'cascade', true);
			$table->integer('position')->nullable();
			$table->string('item_code')->nullable();
			$table->string('subject')->nullable();
			$table->string('definition')->nullable();
			$table->string('price')->nullable();
			$table->string('unit_type')->nullable();
			$table->float('amount')->nullable();
			$table->string('sum')->nullable();
			$table->float('tax')->nullable();
			$table->string('sum_tax')->nullable();
			$table->float('discount')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_invoice_items');
    }
}
