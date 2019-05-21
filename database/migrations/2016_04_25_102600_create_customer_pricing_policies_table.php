<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;


class CreateCustomerPricingPoliciesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_pricing_policies', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->fks([
				'customer_id',
				'product_group_id'
			], 'cascade', true);

			$table->integer('products_range')->nullable()->default(1);
			$table->decimal('price', 20, 2)->nullable()->default(0.00);

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
		Schema::dropIfExists('customer_pricing_policies');
	}
}
