<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerInvoiceAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_invoice_attachments', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->fk([
				'column' => 'customer_invoice_id',
				'table' => 'customer_invoices',
			], 'cascade', true);
			$table->string('attachment_type')->nullable();
			$table->string('filename')->nullable();
			$table->string('file')->nullable();

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
        Schema::dropIfExists('customer_invoice_attachments');
    }
}
