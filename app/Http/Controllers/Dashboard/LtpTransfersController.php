<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use App\Jobs\SendToLTP;
use App\LtpTransfer;
use App\Repositories\Contracts\LtpTransferRepository;
use App\Support\LtpHttpClient;
use App\Transformers\Dashboard\LtpTransferTransformer;
use Carbon\Carbon;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use Illuminate\Contracts\Auth\Access\Gate;
use Spatie\ArrayToXml\ArrayToXml;

/**
 * LtpTransfer controller.
 *
 * @package App\Http\Controllers\Dashboard
 */
class LtpTransfersController extends ResourceController
{
    use DashboardSidebar;

    /**
     * @var Gate
     */
    protected $gate;

    /**
     * @var string
     */
    protected $prefix = 'dashboard';

    /**
     * @var string
     */
    protected $resource = 'ltp_transfer';

    /**
     * @var array
     */
    protected $with = [
        'items',
    ];

    /**
     * @var array
     */
    protected $editActionFormData = [

    ];

    /**
     * @var array
     */
    protected $popupActions = [
        'create' => 'large',
        'edit' => 'large'
    ];

    /**
     * @var LtpHttpClient
     */
    protected $ltpHttpClient;

    public function __construct(
        Gate $gate,
        LtpTransferRepository $ltpTransferRepository,
        LtpHttpClient $ltpHttpClient
    )
    {
        $this->gate = $gate;
        $this->repository = $ltpTransferRepository;
        $this->ltpHttpClient = $ltpHttpClient;

        $this->middleware('auth:dashboard');
        $this->shareSidebar();
        parent::__construct();
    }

    public function sendToLtp(Request $request)
    {
        $result = SendToLTP::dispatchNow($this->getResourceId());

        return response($result ?: 'Error');
    }

    public function updateStatuses(Request $request)
    {
        #todo: here will be request to LTP, download xml and parse it to new data
    }

    public function xml(Request $request)
    {
        $ltpTransfer = $this->repository->find($this->getResourceId());
        $ltpXml = LtpTransferTransformer::toLtpXml($ltpTransfer);
        $xml = ArrayToXml::convert($ltpXml, 'Documents', true, 'UTF-8');

        return response($xml, 200, [
            'Content-Type' => 'text/xml; charset=UTF8'
        ]);
    }
}
