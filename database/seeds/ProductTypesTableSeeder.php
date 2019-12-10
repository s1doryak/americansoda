<?php

use Illuminate\Database\Seeder;

class ProductTypesTableSeeder extends Seeder
{
    public function run()
    {




        factory(App\ProductType::class, 5)->create()->each(function (App\ProductType $productType) {



        });
    }
}