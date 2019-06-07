<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerPreOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_pre_order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->fk([
				'column' => 'customer_pre_order_id',
				'table' => 'customer_pre_orders',
			], 'cascade', true);
			$table->fk([
				'column' => 'customer_user_id',
				'table' => 'customer_users',
			], 'cascade', true);
			$table->fk([
				'column' => 'customer_id',
				'table' => 'customers',
			], 'cascade', true);
			$table->fk([
				'column' => 'product_id',
				'table' => 'products',
			], 'cascade', true);
			$table->string('quantity')->nullable();
			$table->string('products_quantity')->nullable();
			$table->string('price')->nullable();
			$table->string('vat_price')->nullable();
			$table->string('total_price')->nullable();
			$table->string('total_vat_price')->nullable();
			$table->string('deposit_price')->nullable();
			$table->string('deposit_vat_price')->nullable();
			$table->string('total_deposit_price')->nullable();
			$table->string('total_deposit_vat_price')->nullable();

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
        Schema::dropIfExists('customer_pre_order_items');
    }
}
