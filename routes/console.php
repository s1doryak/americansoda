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

Artisan::command('maventa:import', function () {
    /** @var \Crmplease\Maventa\Maventa $maventa */
    $maventa = app(\Crmplease\Maventa\Maventa::class);

    /** @var \Illuminate\Support\Collection $invoiceList */
    $invoiceList = collect(
        $maventa->invoice_list_between_dates(now()->startOfYear()->format('YmdHis'), now()->format('YmdHis'), 2)
    );

    foreach ($invoiceList as $invoice) {
        \App\Jobs\MaventaImportInvoice::dispatch($invoice->id, true);
    }

    return;
});
