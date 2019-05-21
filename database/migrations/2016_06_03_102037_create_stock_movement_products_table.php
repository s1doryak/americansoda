<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;


class CreateStockMovementProductsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stock_movement_products', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->fks([
				'stock_movement_id',
				'product_id'
			], 'set null', true);

			$table->string('product_name')->nullable();
			$table->integer('products_quantity')->nullable();
			$table->string('delivery_number')->nullable()->default(null);
			$table->string('expiration_date')->nullable()->default(null);
			$table->string('movement_type')->nullable();
			$table->text('comment')->nullable();

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
		Schema::dropIfExists('stock_movement_products');
	}
}
