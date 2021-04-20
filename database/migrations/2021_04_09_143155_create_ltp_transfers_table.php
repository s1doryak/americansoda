<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateLtpTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ltp_transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('document_type')->default('SO');
            $table->string('document_number')->nullable();
            $table->string('document_aggregate')->nullable();
            $table->string('parent_document_number')->nullable();
            $table->date('picking_date')->nullable();
            $table->date('requested_delivery_date')->nullable();
            $table->dateTime('requested_delivery_timestamp')->nullable();
            $table->date('document_date')->nullable();
            $table->string('warehouse')->nullable();
            $table->string('comment')->nullable();
            $table->string('owner_reference')->nullable();
            $table->string('invoice_reference')->nullable();
            $table->string('seller_info')->nullable();
            $table->string('delivery_route')->nullable();
            $table->string('delivery_route_load')->nullable();
            $table->string('delivery_drop')->nullable();
            $table->integer('delivery_class')->nullable();
            $table->string('delivery_terminal_info')->nullable();
            $table->integer('picking_method')->nullable();
            $table->decimal('weight')->nullable();
            $table->decimal('volume')->nullable();
            $table->integer('status_code')->nullable();
            $table->dateTime('delivery_start')->nullable();
            $table->dateTime('delivery_end')->nullable();

            $table->string('document_party_type')->nullable();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('zip')->nullable();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('country')->nullable();
            $table->string('information')->nullable();
            $table->string('iln')->nullable();
            $table->string('edi_identifier')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            $table->unsignedBigInteger('waybill')->nullable();

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
        Schema::dropIfExists('ltp_transfers');
    }
}
