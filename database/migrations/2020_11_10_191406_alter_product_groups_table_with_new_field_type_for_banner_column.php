<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AlterProductGroupsTableWithNewFieldTypeForBannerColumn extends Migration
{
    public function up()
    {
        Schema::table('product_groups', function (Blueprint  $table) {
            $table->longText('banner')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('product_groups', function (Blueprint  $table) {
            $table->text('banner')->nullable()->change();
        });
    }
}
