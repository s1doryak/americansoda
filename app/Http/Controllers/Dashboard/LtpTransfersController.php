<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Dashboard\Traits\DashboardSidebar;
use App\Jobs\SendToLTP;
use App\LtpTransfer;
use App\LtpTransferItem;
use App\Repositories\Contracts\LtpMessageRepository;
use App\Repositories\Contracts\LtpTransferRepository;
use App\Support\LtpHttpClient;
use App\Transformers\Dashboard\LtpMessageTransformer;
use App\Transformers\Dashboard\LtpTransferTransformer;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Routing\ResourceController;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use SimpleXMLElement;
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
        'customerShipment'
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
            $this->handleLtpMessages($result['body']);
            $content = trans("models/{$this->resource}.ltpUpdate.success");
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

    protected function handleLtpMessages(array $response)
    {
        foreach ($response as $message) {
            $ltpMessage = LtpMessageTransformer::responseToLtpMessage($message);
            $this->ltpMessages->create($ltpMessage);
            $this->handleLtpMessage($ltpMessage);
        }
    }

    protected function handleLtpMessage(array $message)
    {
        $xml = base64_decode($message['content']);
        $documents = new SimpleXMLElement($xml);

        foreach ($documents as $document) {
            $documentNumber = in_array(config('app.env'), ['prod', 'production'])
                ? $document->DocumentNumber
                : Str::after($document->DocumentNumber, 'TEST-');
            /** @var LtpTransfer $ltpTransfer */
            $ltpTransfer = $this->repository->firstWhere(['document_number' => $documentNumber]);

            if ($ltpTransfer) {
                $ltpTransfer->update(['picking_date' => (string)$document->PickingDate]);
                $ltpTransfer->touch();
                $this->handleLtpDocumentItems(
                    $document->xpath('DocumentLine'),
                    $ltpTransfer->items
                );
            }
        }
    }

    /**
     * @param SimpleXMLElement[] $documentLines
     * @param Collection $transferItems
     */
    protected function handleLtpDocumentItems($documentLines, Collection $transferItems)
    {
        foreach ($documentLines as $documentLine) {
            $transferItems
                ->filter(function (LtpTransferItem $transferItem) use ($documentLine) {
                    return $transferItem->product_ean === (string)$documentLine->ProductEan
                        && intval($transferItem->original_quantity) === intval($documentLine->OriginalQuantity);
                })
                ->map(function (LtpTransferItem $transferItem) use ($documentLine) {
                    $transferItem->processed_quantity = (string)$documentLine->ProcessedQuantity;
                    $transferItem->product_group_id = (string)$documentLine->ProductGroupId ?: null;
                    $transferItem->picked = floor(($documentLine->ProcessedQuantity / $documentLine->OriginalQuantity) * 100);
                    $transferItem->unmodified_original_quantity = (string)$documentLine->UnmodifiedOriginalQuantity;
                    $transferItem->updated_at = now();
                    $transferItem->save();
                });
        }
    }
}
