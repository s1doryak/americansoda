<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropArchivedColumnFromCustomersTable extends Migration
{
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('archived');
        });

        Schema::table('customer_revisions', function (Blueprint $table) {
            $table->dropColumn('archived');
        });
    }

    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->boolean('archived')->nullable();
        });

        Schema::table('customer_revisions', function (Blueprint $table) {
            $table->boolean('archived')->nullable();
        });
    }
}
