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

class MaventaImportInvoiceImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var object
     */
    public $invoice;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Execute the job.
     *
     * @param Maventa $maventa
     * @param CustomerInvoiceRepository $customerInvoiceRepository
     *
     * @return void|\Crmplease\MaterialAdmin\Database\Eloquent\Traits\File\FileField
     */
    public function handle(
        Maventa $maventa,
        CustomerInvoiceRepository $customerInvoiceRepository
    )
    {
        /** @var CustomerInvoice|null $invoice */
        $invoice = $customerInvoiceRepository->firstWhere(['maventa_id' => $this->invoice->id]);

        if ($invoice) {
            $files = $maventa->get_invoice_image_as_format($this->invoice->id, 'TIFF');

            foreach ($files as $file) {
                $path = sprintf('%s/%s', sys_get_temp_dir(), $file->filename);

                file_put_contents($path, base64_decode($file->file));

                $invoice->update([
                    'maventa_tiff' => $path
                ]);

                unlink($path);
            }

            return $invoice->maventa_tiff;
        }

        return;
    }
}
