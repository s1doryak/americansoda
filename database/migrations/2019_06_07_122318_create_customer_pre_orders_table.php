<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerPreOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_pre_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->fk([
				'column' => 'customer_user_id',
				'table' => 'customer_users',
			], 'cascade', true);
			$table->fk([
				'column' => 'customer_order_id',
				'table' => 'customer_orders',
			], 'cascade', true);
			$table->fk([
				'column' => 'customer_id',
				'table' => 'customers',
			], 'cascade', true);
			$table->string('number')->nullable();
			$table->string('reference_number')->nullable();
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
        Schema::dropIfExists('customer_pre_orders');
    }
}
