<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;


class CreateCustomersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customers', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->fks([
				'stock_id',
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
			], 'set null', true);

			$table->string('name')->nullable();
			$table->string('legal_name')->nullable();
			$table->string('billing_postcode')->nullable();
			$table->string('billing_address')->nullable();
			$table->string('shipping_postcode')->nullable();
			$table->string('shipping_address')->nullable();
			$table->string('bid')->nullable();
			$table->string('iban')->nullable()->default('');
			$table->string('swift')->nullable()->default('');
			$table->string('email');
			$table->string('phone')->nullable();
			$table->unsignedInteger('order_interval')->nullable();
			$table->longText('comment')->nullable();
			$table->longText('calendar_comment')->nullable();
			$table->string('incomterms')->nullable()->default('');
			$table->text('terms_of_cooperation')->nullable();
			$table->text('terms_of_delivery')->nullable();
			$table->text('terms_of_equipment')->nullable();
			$table->string('delivery_payer')->nullable()->default('');
			$table->string('payment_conditions')->nullable()->default('');
			$table->boolean('pays_vat')->nullable()->defaulf(false);

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
		Schema::dropIfExists('customers');
	}
}
