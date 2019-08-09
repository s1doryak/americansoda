<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->fk([
				'column' => 'customer_id',
				'table' => 'customers',
			], 'cascade', true);
			$table->fk([
				'column' => 'shipment_id',
				'table' => 'customer_shipments',
			], 'cascade', true);
			$table->string('maventa_id')->nullable();
			$table->text('maventa_tiff')->nullable();
			$table->boolean('maventa_initiated')->nullable();
			$table->string('currency')->nullable();
			$table->string('data')->nullable();
			$table->string('date')->nullable();
			$table->string('date_due')->nullable();
			$table->string('delivery_date')->nullable();
			$table->string('delivery_type')->nullable();
			$table->string('error_message')->nullable();
			$table->string('invoice_delivery_address')->nullable();
			$table->string('invoice_nr')->nullable();
			$table->string('invoice_seller_information')->nullable();
			$table->string('lang')->nullable();
			$table->text('notes')->nullable();
			$table->string('order_nr')->nullable();
			$table->string('payment_terms')->nullable();
			$table->string('reference_nr')->nullable();
			$table->integer('state')->nullable();
			$table->string('status')->nullable();
			$table->string('sum')->nullable();
			$table->string('sum_tax')->nullable();
			$table->string('work_order_nr')->nullable();
			$table->string('company_interest')->nullable();
			$table->string('company_paper_fee')->nullable();
			$table->string('company_reminder')->nullable();
			$table->text('company_comment')->nullable();
			$table->string('company_reference')->nullable();
			$table->string('customer_nr')->nullable();
			$table->string('customer_email')->nullable();
			$table->string('customer_name')->nullable();
			$table->string('customer_country')->nullable();
			$table->string('customer_state')->nullable();
			$table->string('customer_post_code')->nullable();
			$table->string('customer_post_office')->nullable();
			$table->string('customer_address1')->nullable();
			$table->string('customer_address2')->nullable();
			$table->string('customer_contact_p')->nullable();
			$table->string('customer_bid')->nullable();
			$table->string('customer_ovt')->nullable();

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
        Schema::dropIfExists('customer_invoices');
    }
}
