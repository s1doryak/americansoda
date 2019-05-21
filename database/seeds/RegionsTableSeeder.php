<?php

use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    public function run()
    {




        factory(App\Region::class, 5)->create()->each(function (App\Region $region) {



        });
    }
}