<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use \Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AlterCustomerUsersTableWithToken extends Migration
{
    public function up()
    {
        $this->updateTable();
    }

    public function down()
    {
        $this->backToOldState();
    }

    protected function updateTable()
    {
        Schema::table('customer_users', function (Blueprint $table) {
            $table->longText('token')->nullable();
        });
    }

    protected function backToOldState()
    {
        Schema::table('customer_users', function (Blueprint $table) {
            $table->dropColumn('token');
        });
    }
}
