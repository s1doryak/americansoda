<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerUserSubscribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_user_subscribes', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->fk([
				'column' => 'product_id',
				'table' => 'products',
			], 'cascade', true);
			$table->fk([
				'column' => 'customer_user_id',
				'table' => 'customer_users',
			], 'cascade', true);


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
        Schema::dropIfExists('customer_user_subscribes');
    }
}
