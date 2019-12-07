<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class DropCustomerUserTokesTable extends Migration
{
    public function up()
    {
        $this->dropTable();
    }

    public function down()
    {
        $this->createTable();
    }

    protected function dropTable()
    {
        Schema::dropIfExists('customer_user_tokens');
    }

    protected function createTable()
    {
        Schema::create('customer_user_tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->fk([
                'column' => 'customer_user_id',
                'table' => 'customer_users',
            ], 'cascade', true);
            $table->string('token')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }
}
