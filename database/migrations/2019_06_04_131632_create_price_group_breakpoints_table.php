<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreatePriceGroupBreakpointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_group_breakpoints', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->fk([
				'column' => 'price_group_id',
				'table' => 'price_groups',
			], 'cascade', true);
			$table->float('breakpoint')->nullable();

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
        Schema::dropIfExists('price_group_breakpoints');
    }
}
