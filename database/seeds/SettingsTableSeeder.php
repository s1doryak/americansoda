<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    public function run()
    {




        factory(App\Setting::class, 5)->create()->each(function (App\Setting $setting) {



        });
    }
}