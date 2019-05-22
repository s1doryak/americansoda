<?php

use Illuminate\Database\Seeder;

class AssembliesTableSeeder extends Seeder
{
    public function run()
    {




        factory(App\Assembly::class, 5)->create()->each(function (App\Assembly $assembly) {



        });
    }
}