<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ChangeInfoCollationInProductGroupsTable extends Migration
{
    public function up()
    {
        DB::statement('ALTER TABLE product_groups modify info text charset utf8mb4;');
    }

    public function down()
    {
    }
}
