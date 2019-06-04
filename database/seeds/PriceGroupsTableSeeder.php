<?php

use Illuminate\Database\Seeder;

class PriceGroupsTableSeeder extends Seeder
{
    public function run()
    {




        factory(App\PriceGroup::class, 5)->create()->each(function (App\PriceGroup $priceGroup) {



        });
    }
}