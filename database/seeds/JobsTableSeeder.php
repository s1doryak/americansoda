<?php

use Illuminate\Database\Seeder;

class JobsTableSeeder extends Seeder
{
    public function run()
    {
        factory(App\Job::class, 10)->create();
    }
}
