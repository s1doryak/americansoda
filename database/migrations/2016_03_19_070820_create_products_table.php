<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;


class CreateProductsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->fks([
				'brand_id',
				'package_type_id',
				'product_group_id'
			], 'set null', true);

			$table->string('name')->nullable();
			$table->string('product_barcode')->nullable();
			$table->string('product_barcode_plaintext')->nullable();
			$table->string('package_barcode')->nullable();
			$table->string('package_barcode_plaintext')->nullable();
			$table->text('product_image')->nullable();
			$table->text('package_image')->nullable();
			$table->longText('description')->nullable();
			$table->longText('contents')->nullable();
			$table->integer('number_in_package')->nullable();
			$table->float('weight', 8, 4)->nullable();
			$table->float('volume', 8, 4)->nullable();
			$table->float('brutto_weight', 8, 4)->nullable();
			$table->float('brutto_volume', 8, 8)->nullable();

			$table->boolean('deposit_enabled')->nullable()->default(false);
			$table->float('deposit_price', 8, 8)->nullable();
			$table->unsignedInteger('deposit_vat')->nullable();
			$table->float('deposit_vat_price', 8, 2)->nullable();

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
		Schema::dropIfExists('products');
	}
}
