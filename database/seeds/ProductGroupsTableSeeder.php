<?php

use Illuminate\Database\Seeder;

class ProductGroupsTableSeeder extends Seeder
{
    public function run()
    {




        factory(App\ProductGroup::class, 5)->create()->each(function (App\ProductGroup $productGroup) {



        });
    }
}