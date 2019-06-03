<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_bank_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->fk([
				'column' => 'company_id',
				'table' => 'companies',
			], 'cascade', true);
			$table->string('bank')->nullable();
			$table->string('swift')->nullable();
			$table->string('account')->nullable();
			$table->string('iban')->nullable();
			$table->boolean('default')->nullable();

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
        Schema::dropIfExists('company_bank_accounts');
    }
}
