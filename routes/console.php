<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('maventa', function () {
	/** @var \Crmplease\Maventa\Maventa $maventa */
	$maventa = app(\Crmplease\Maventa\Maventa::class);

	dd($maventa->invoice_show('3b7e7c52-7838-4964-a452-87be36dfa181'));
});