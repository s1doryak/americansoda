<?php

use Illuminate\Database\Seeder;

class FailedJobsTableSeeder extends Seeder
{
    public function run()
    {
        factory(App\FailedJob::class, 10)->create();
    }
}
