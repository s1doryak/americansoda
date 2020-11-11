<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AlterCustomersTableWithZendeskIdColumn extends Migration
{
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->bigInteger('zendesk_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('zendesk_id');
        });
    }
}
