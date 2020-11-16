<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProductGroupsTable extends Migration
{
    public function up()
    {
        Schema::table('product_groups', function (Blueprint $table) {
            $table->longText('info')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('product_groups', function (Blueprint $table) {
            $table->text('info')->nullable()->change();
        });
    }
}
