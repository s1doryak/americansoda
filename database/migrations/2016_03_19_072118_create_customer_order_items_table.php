<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;


class CreateCustomerOrderItemsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_order_items', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->fks([
				'product_id',
				'customer_id',
				'customer_order_id',
				'customer_shipment_id'
			], 'set null', true);

			$table->string('status')->nullable()->default('open');

			$table->string('product_name')->nullable();
			$table->float('sales_unit_quantity')->nullable();;
			$table->boolean('product_manual_price')->nullable()->defaulf(false);
			$table->decimal('product_price', 20, 4)->nullable();
			$table->unsignedInteger('vat')->nullable();
			$table->decimal('product_vat_price', 20, 4)->nullable();
			$table->unsignedInteger('products_quantity')->nullable();
			$table->unsignedInteger('packages_quantity')->nullable();
			$table->decimal('total_price', 20, 4)->nullable();
			$table->decimal('total_vat_price', 20, 4)->nullable();

			$table->boolean('deposit_enabled')->nullable()->default(false);
			$table->decimal('deposit_price', 20, 8)->nullable();
			$table->unsignedInteger('deposit_vat')->nullable();
			$table->decimal('deposit_vat_price', 20, 2)->nullable();;
			$table->decimal('deposit_total_price', 20, 8)->nullable();;
			$table->decimal('deposit_total_vat')->nullable();
			$table->decimal('deposit_total_vat_price', 20, 2)->nullable();

			$table->boolean('bypass')->nullable()->default(false);
			$table->boolean('back_order')->nullable()->default(false);
			$table->boolean('cancelled')->nullable()->default(false);
			$table->timestamp('expected_date')->nullable()->default(null);

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
		Schema::dropIfExists('customer_order_items');
	}
}
