<?php

use App\Repositories\Contracts\UserRepository;
use App\Repositories\Eloquent\UserRepositoryEloquent;
use Crmplease\MaterialAdmin\Database\Schema\Blueprint;
use Crmplease\MaterialAdmin\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class DropAdministratorsTable extends Migration
{
    public function up()
    {
        $this->dropAdministrators();
    }

    public function down()
    {
        //
    }

    protected function dropAdministrators()
    {
        Schema::table('administrators', function (Blueprint $table) {
            $table->drop();
        });
    }
}
