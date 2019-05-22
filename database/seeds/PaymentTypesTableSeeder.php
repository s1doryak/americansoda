<?php

use Illuminate\Database\Seeder;

class PaymentTypesTableSeeder extends Seeder
{
    public function run()
    {




        factory(App\PaymentType::class, 5)->create()->each(function (App\PaymentType $paymentType) {



        });
    }
}