<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateLtpTransferItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ltp_transfer_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('line_number')->nullable();
            $table->string('client_purchase_order')->nullable();
            $table->string('client_purchase_order_line')->nullable();
            $table->string('product_code')->nullable();
            $table->string('product_ean')->nullable();
            $table->string('product_package_ean')->nullable();
            $table->string('product_identifier')->nullable();
            $table->integer('product_identifier_class_id')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_group')->nullable();
            $table->decimal('original_quantity')->nullable();
            $table->string('product_unit')->default('BOX');
            $table->decimal('processed_quantity')->nullable();
            $table->decimal('net_weight')->nullable();
            $table->string('net_weight_unit')->nullable();
            $table->decimal('price_per_unit')->nullable();
            $table->decimal('price_per_unit_with_tax')->nullable();
            $table->decimal('vat_rate')->nullable();
            $table->string('currency')->nullable();
            $table->decimal('selling_price_per_unit')->nullable();
            $table->string('comment')->nullable();
            $table->string('require_sample')->nullable();
            $table->decimal('quantity_selling_unit')->nullable();
            $table->decimal('unmodified_original_quantity')->nullable();
            $table->integer('product_group_id')->nullable();
            $table->string('warehouse')->nullable();
            $table->integer('delivery_class')->nullable();
            $table->date('required_best_before')->nullable();
            $table->string('required_batch_code')->nullable();
            $table->integer('process_instruction')->nullable();

            $table->fk('ltp_transfer_id', 'set null', true);

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
        Schema::dropIfExists('ltp_transfer_items');
    }
}
