<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;


class CreateAdministratorsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('administrators', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->fks([
				'role_id',
				'company_id'
			], 'cascade', true);

			$table->string('email')->unique();
			$table->string('password')->nullable();
			$table->string('name')->nullable();
			$table->string('phone')->nullable();
			$table->text('avatar')->nullable();

			$table->rememberToken();
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
		Schema::dropIfExists('administrators');
	}
}
