<?php

use Illuminate\Database\Seeder;

class LtpMessagesTableSeeder extends Seeder
{
    public function run()
    {




        factory(App\LtpMessage::class, 5)->create()->each(function (App\LtpMessage $ltpMessage) {



        });
    }
}