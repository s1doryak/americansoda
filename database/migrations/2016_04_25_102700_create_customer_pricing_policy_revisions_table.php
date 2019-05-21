<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;


class CreateCustomerPricingPolicyRevisionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_pricing_policy_revisions', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->fks([
				'customer_id',
				'product_group_id',
				[
					'column' => 'editor_id',
					'table' => 'users'
				],
				[
					'column' => 'customer_pricing_policy_id',
					'fkname' => 'cpp_id'
				],
				[
					'column' => 'revision_id',
					'table' => 'customer_pricing_policy_revisions',
					'fkname' => 'cpprv_id'
				]
			], 'cascade', true);

			$table->unsignedBigInteger('revision_number')->nullable();
			$table->string('revision_type')->nullable();
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
		Schema::dropIfExists('customer_pricing_policy_revisions');
	}
}
