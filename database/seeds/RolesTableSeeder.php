<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {




        factory(App\Role::class, 5)->create()->each(function (App\Role $role) {



        });
    }
}