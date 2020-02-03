<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCustomersTableMakeEmailNullable extends Migration
{
    public function up()
    {
        $this->makeEmailNullable();
    }

    public function down()
    {
        $this->makeEmailNotNullable();
    }

    protected function makeEmailNullable()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('email')->nullable()->change();
        });
    }

    protected function makeEmailNotNullable()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('email')->change();
        });
    }
}
