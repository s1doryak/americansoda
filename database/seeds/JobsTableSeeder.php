<?php

use Illuminate\Database\Seeder;

class JobsTableSeeder extends Seeder
{
    public function run()
    {




        factory(App\Job::class, 5)->create()->each(function (App\Job $job) {



        });
    }
}