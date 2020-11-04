<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class UpdateProductsTable10788a7ef extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {

			$table->boolean('new')->nullable();
			$table->boolean('action')->nullable();
			$table->dateTime('future_stock_movement')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {

            $table->dropColumn('new');
            $table->dropColumn('action');
            $table->dropColumn('future_stock_movement');

        });
    }
}
