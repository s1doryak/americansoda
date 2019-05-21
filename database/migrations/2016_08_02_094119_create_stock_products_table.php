<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;


class CreateStockProductsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stock_products', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->fks([
				'stock_id',
				'product_id',
				'customer_order_item_id'
			], 'set null', true);

			$table->string('delivery_number')->nullable();
			$table->timestamp('expiration_date')->nullable()->defaults(null);

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
		Schema::dropIfExists('stock_products');
	}
}
