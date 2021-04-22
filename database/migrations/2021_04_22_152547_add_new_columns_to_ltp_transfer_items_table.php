<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnsToLtpTransferItemsTable extends Migration
{
    public function up()
    {
        Schema::table('ltp_transfer_items', function (Blueprint $table) {
            $table->string('selling_unit')->nullable();
        });

        Schema::table('ltp_transfers', function (Blueprint $table) {
            $table->renameColumn('invoice_reference', 'invoicing_reference');
        });
    }

    public function down()
    {
        Schema::table('ltp_transfer_items', function (Blueprint $table) {
            $table->dropColumn('selling_unit');
        });

        Schema::table('ltp_transfers', function (Blueprint $table) {
            $table->renameColumn('invoicing_reference', 'invoice_reference');
        });
    }
}
