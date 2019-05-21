<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;


class CreateCustomerOrdersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_orders', function (Blueprint $table) {
			$table->bigIncrements('id');
            $table->fks([
                'customer_id',
                'user_id',
            ], 'set null', true);

			$table->string('number')->nullable();
			$table->string('batch_number')->nullable()->default('');

			$table->longText('comment')->nullable();

			$table->integer('fc_overdue')->nullable()->default(0);
			$table->longText('fc_comment')->nullable();
			$table->longText('fc_future_comment')->nullable();

            $table->timestamp('sent_at')->nullable()->default(null);

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
		Schema::dropIfExists('customer_orders');
	}
}
