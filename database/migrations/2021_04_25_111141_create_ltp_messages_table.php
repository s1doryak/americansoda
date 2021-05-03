<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateLtpMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ltp_messages', function (Blueprint $table) {
			$table->bigIncrements('id');

			$table->string('sender_identifier')->nullable();
			$table->string('sender_description')->nullable();
			$table->string('filename_hint')->nullable();
			$table->longText('content')->nullable();

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
        Schema::dropIfExists('ltp_messages');
    }
}
