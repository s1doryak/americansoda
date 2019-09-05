<?php

namespace App\Jobs;

use App\CustomerInvoice;
use App\Repositories\Contracts\CustomerInvoiceRepository;
use Crmplease\Maventa\Maventa;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class MaventaConfirmInvoice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var integer
     */
    public $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @param Maventa $maventa
     * @param CustomerInvoiceRepository $customerInvoiceRepository
     *
     * @return boolean|string
     */
    public function handle(
        Maventa $maventa,
        CustomerInvoiceRepository $customerInvoiceRepository
    )
    {
        /** @var CustomerInvoice $customerInvoice */
        if ($customerInvoice = $customerInvoiceRepository->find($this->id)) {

            $payment_date = now()->format('Ymd');

            /** @var object $result */
            $result = $maventa->invoice_confirm(
                $customerInvoice->maventa_id,
                $payment_date
            );

            if ($result === 'OK: INVOICE MARKED AS PAID') {

                $customerInvoiceRepository->update([
                    'maventa_paid' => true,
                    //'maventa_paid_at' => now()
                ], $this->id);

            }

            return $result;
        }

        return false;
    }
}
