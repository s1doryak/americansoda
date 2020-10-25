<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class UpdateProductsTable1d4d6257b extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {

			$table->float('discount_price')->nullable();

        });
    }


    public function down()
    {
        //
    }
}
