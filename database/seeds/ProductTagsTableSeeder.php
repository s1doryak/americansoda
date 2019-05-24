<?php

use Illuminate\Database\Seeder;

class ProductTagsTableSeeder extends Seeder
{
    public function run()
    {




        factory(App\ProductTag::class, 5)->create()->each(function (App\ProductTag $productTag) {



        });
    }
}