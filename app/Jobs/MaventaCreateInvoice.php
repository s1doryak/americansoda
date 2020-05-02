<?php

namespace App\Jobs;

use App\Repositories\Contracts\CustomerInvoiceRepository;
use App\Transformers\Dashboard\CustomerInvoiceTransformer;
use Crmplease\Maventa\Maventa;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class MaventaCreateInvoice implements ShouldQueue
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
     * @return boolean|object
     */
    public function handle(
        Maventa $maventa,
        CustomerInvoiceRepository $customerInvoiceRepository
    )
    {

        if ($customerInvoice = $customerInvoiceRepository->find($this->id)) {

            /** @var object $result */
            $result = $maventa->invoice_create(
                CustomerInvoiceTransformer::toMaventa($customerInvoice)
            );

            if ($result->status === 'OK: INVOICE CREATED') {

                $customerInvoiceRepository->update([
                    'maventa_sent_at' => now()
                ], $this->id);

            }

            return $result;
        }

        return false;
    }
}
