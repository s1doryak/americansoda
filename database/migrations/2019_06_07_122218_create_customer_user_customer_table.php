<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerUsercustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_user_customer', function (Blueprint $table) {
            $table->fks([
                'customer_user_id',
                'customer_id'
            ], 'cascade', true);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_user_customer');
    }
}
