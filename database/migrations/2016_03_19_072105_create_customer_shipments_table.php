<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;


class CreateCustomerShipmentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_shipments', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->fks([
				'package_type_id',
				'customer_id',
				'user_id',
			], 'set null', true);

			$table->string('number')->nullable()->default('');
			$table->string('assembly_number')->nullable()->default('');
			$table->string('invoice_number')->nullable()->default('');
			$table->string('status')->nullable()->defaults('open');
			$table->string('delivery_type')->nullable();
			$table->unsignedInteger('packages_quantity')->nullable();
			$table->longText('comment')->nullable();

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
		Schema::dropIfExists('customer_shipments');
	}
}
