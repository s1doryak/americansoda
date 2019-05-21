<?php

use Illuminate\Database\Seeder;

class PackageTypesTableSeeder extends Seeder
{
    public function run()
    {




        factory(App\PackageType::class, 5)->create()->each(function (App\PackageType $packageType) {



        });
    }
}