<?php

use Illuminate\Database\Seeder;

class AuthLogsTableSeeder extends Seeder
{
    public function run()
    {




        factory(App\AuthLog::class, 5)->create()->each(function (App\AuthLog $authLog) {



        });
    }
}