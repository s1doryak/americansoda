<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;


class CreateCompaniesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->fk('region_id', 'set null', true);

			$table->string('name')->nullable();
			$table->string('legal_name')->nullable();
			$table->string('short_name')->nullable();
			$table->string('postcode')->nullable();
			$table->string('address')->nullable();
			$table->string('bid')->nullable();
			$table->string('email')->nullable();
			$table->string('phone')->nullable();
			$table->string('code')->nullable();

			$table->string('smtp_host')->nullable();
			$table->string('smtp_port')->nullable();
			$table->string('smtp_encryption')->nullable();
			$table->string('smtp_username')->nullable();
			$table->string('smtp_password')->nullable();
			$table->string('smtp_from')->nullable();
			$table->string('smtp_from_name')->nullable();

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
		Schema::dropIfExists('companies');
	}
}
