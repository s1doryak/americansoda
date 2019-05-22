<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;


class CreateCustomerRevisionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_revisions', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->fks([
				[
					'column' => 'billing_region_id',
					'table' => 'regions'
				],
				[
					'column' => 'shipping_region_id',
					'table' => 'regions'
				],
				'customer_type_id',
				'payment_type_id',
				'user_id',
				[
					'column' => 'editor_id',
					'table' => 'users'
				],
				'customer_id',
				'stock_id'
			], 'cascade', true);

			$table->string('revision_type')->nullable();
			$table->string('name')->nullable();
			$table->string('legal_name')->nullable();
			$table->string('billing_postcode')->nullable();
			$table->string('billing_address')->nullable();
			$table->string('shipping_postcode')->nullable();
			$table->string('shipping_address');
			$table->string('bid')->nullable();
			$table->string('iban')->nullable()->defaults('');
			$table->string('swift')->nullable()->defaults('');
			$table->string('email');
			$table->string('phone')->nullable();
			$table->unsignedInteger('order_interval')->nullable();
			$table->longText('comment')->nullable();
			$table->longText('calendar_comment')->nullable();
			$table->string('incomterms')->nullable()->default('');
			$table->text('terms_of_cooperation')->nullable();
			$table->text('terms_of_delivery')->nullable();
			$table->text('terms_of_equipment')->nullable();
			$table->string('delivery_payer')->default('');
			$table->string('payment_conditions')->default('');
			$table->boolean('pays_vat')->nullable()->defaults(false);

			$table->unsignedBigInteger('revision_id')->nullable();
			$table->foreign('revision_id', 'crv_id')
				->references('id')
				->on('customer_revisions')
				->onDelete('cascade');

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
		Schema::dropIfExists('customer_revisions');
	}
}
