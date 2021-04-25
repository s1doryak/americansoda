<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use App\Jobs\SendToLTP;
use App\Repositories\Contracts\LtpMessageRepository;
use App\Repositories\Contracts\LtpTransferRepository;
use App\Support\LtpHttpClient;
use App\Transformers\Dashboard\LtpMessageTransformer;
use App\Transformers\Dashboard\LtpTransferTransformer;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Http\Response;
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
    protected $defaultMiddleware = 'auth:dashboard';

    /**
     * @var string
     */
    protected $prefix = 'dashboard';

    /**
     * @var string
     */
    protected $resource = 'ltp_transfer';

    /**
     * @var string
     */
    protected $translationPrefix = 'models/';

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
        'create' => 'fullscreen',
        'edit' => 'fullscreen'
    ];

    /**
     * @var LtpHttpClient
     */
    protected $ltpHttpClient;

    /**
     * @var LtpMessageRepository
     */
    protected $ltpMessages;

    public function __construct(
        Gate $gate,
        LtpTransferRepository $ltpTransferRepository,
        LtpHttpClient $ltpHttpClient,
        LtpMessageRepository $ltpMessages
    )
    {
        $this->gate = $gate;
        $this->repository = $ltpTransferRepository;
        $this->ltpHttpClient = $ltpHttpClient;
        $this->ltpMessages = $ltpMessages;

        $this->middleware('auth:dashboard');
        $this->shareSidebar();
        parent::__construct();
    }

    public function sendToLtp(Request $request)
    {
        $result = SendToLTP::dispatchNow($this->getResourceId());

        if ($result) {
            $code = Response::HTTP_OK;
            $content = $result;
        } else {
            $code = Response::HTTP_FORBIDDEN;
            $content = 'Error';
        }

        return response()->json([
            'message' => $content
        ], $code);
    }

    public function ltpUpdate(Request $request)
    {
        $result = $this->ltpHttpClient->checkDocuments();

        if ($result['code'] === Response::HTTP_OK && !empty($result['body'])) {
            $ltpMessage = LtpMessageTransformer::responseToLtpMessage($result['body']);
            $this->ltpMessages->create($ltpMessage);
            $this->handleLtpMessage($ltpMessage);
            $content =trans("models/{$this->resource}.ltpUpdate.success");
            $code = 200;
        } elseif ($result['code'] === Response::HTTP_OK && empty($result['body'])) {
            $content = trans("models/{$this->resource}.ltpUpdate.empty");
            $code = 204;
        } else {
            $content = trans("models/{$this->resource}.ltpUpdate.error");
            $code = 500;
        }

        return response()->json([
            'message' => $content,
            'code' => $code
        ]);
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

    protected function handleLtpMessage(array $message)
    {

    }
}
