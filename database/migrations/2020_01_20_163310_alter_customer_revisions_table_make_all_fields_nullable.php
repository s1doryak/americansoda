<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCustomerRevisionsTableMakeAllFieldsNullable extends Migration
{
    public function up()
    {
        $this->makeAllFieldsNullable();
    }

    public function down()
    {
        $this->makeAllFieldsNotNullable();
    }

    protected function makeAllFieldsNullable()
    {
        Schema::table('customer_revisions', function (Blueprint $table) {
            $table->string('email')->nullable()->change();
            $table->string('payment_conditions')->default('')->nullable()->change();
            $table->string('delivery_payer')->default('')->nullable()->change();
            $table->string('shipping_address')->nullable()->change();
        });
    }

    protected function makeAllFieldsNotNullable()
    {
        Schema::table('customer_revisions', function (Blueprint $table) {
            $table->string('email')->change();
            $table->string('payment_conditions')->default('')->change();
            $table->string('delivery_payer')->default('')->change();
            $table->string('shipping_address')->change();
        });
    }
}
