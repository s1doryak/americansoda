<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class UpdateCustomersTable1d4f024a4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->fk([
                'column' => 'price_group_id',
                'table' => 'price_groups',
            ], 'cascade', true);
            $table->boolean('archived')->nullable();
            $table->integer('nr')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('post_code')->nullable();
            $table->string('post_office')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('contact_p')->nullable();
            $table->string('ovt')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
