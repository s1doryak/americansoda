<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AlterLtpTransferColumns extends Migration
{
    public function up()
    {
        Schema::table('ltp_transfers', function (Blueprint $table) {
            $table->longText('comment')->nullable()->change();
            $table->longText('information')->nullable()->change();
            $table->dateTime('document_date')->nullable()->change();
            $table->time('requested_delivery_timestamp')->nullable()->change();
            $table->dropColumn('waybill');
        });
    }

    public function down()
    {
        Schema::table('ltp_transfers', function (Blueprint $table) {
            $table->string('comment')->nullable()->change();
            $table->string('information')->nullable()->change();
            $table->date('document_date')->nullable()->change();
            $table->dateTime('requested_delivery_timestamp')->nullable()->change();
            $table->text('waybill')->nullable();
        });
    }
}
