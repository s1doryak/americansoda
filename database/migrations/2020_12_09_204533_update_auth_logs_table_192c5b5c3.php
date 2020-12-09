<?php

use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class UpdateAuthLogsTable192c5b5c3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('auth_logs', function (Blueprint $table) {

            $table->longText('user_agent')->nullable();
            $table->longText('zendesk')->nullable();
            $table->longText('version')->nullable();
            $table->longText('sentry')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auth_logs', function (Blueprint $table) {

            $table->dropColumn('user_agent');
            $table->dropColumn('zendesk');
            $table->dropColumn('version');
            $table->dropColumn('sentry');

        });
    }
}
