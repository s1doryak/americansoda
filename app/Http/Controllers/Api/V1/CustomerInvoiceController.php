<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\CustomerInvoice\DownloadPdfRequest;
use App\Services\Api\V1\CustomerInvoiceService;
use Crmplease\MaterialAdmin\Routing\Controller;

class CustomerInvoiceController extends Controller
{
    protected $prefix = 'api';
    protected $defaultMiddleware = 'api';

    public function downloadInvoice(DownloadPdfRequest $request, CustomerInvoiceService $service)
    {
        return $service->downloadPdfFile($request->route('shipment_id'));
    }
}