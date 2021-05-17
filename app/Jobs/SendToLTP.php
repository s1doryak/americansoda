<?php

namespace App\Jobs;

use App\Repositories\Contracts\LtpTransferRepository;
use App\Support\LtpHttpClient;
use App\Transformers\Dashboard\LtpTransferTransformer;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Response;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\ArrayToXml\ArrayToXml;

class SendToLTP implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle(
        LtpTransferRepository $ltpTransferRepository,
        LtpHttpClient $ltpHttpClient
    )
    {
        if ($ltpTransfer = $ltpTransferRepository->find($this->id)) {
            $sentAt = Carbon::now();
            $ltpXml = LtpTransferTransformer::toLtpXml($ltpTransfer);
            $xml = ArrayToXml::convert($ltpXml, 'Documents', true, 'UTF-8');
            $result = $ltpHttpClient->sendDocuments($xml, $ltpTransfer->document_number);

            if ($result['code'] === Response::HTTP_NO_CONTENT) {
                $ltpTransferRepository->update([
                    'sent_at' => $sentAt
                ], $ltpTransfer->getKey());

                return format_date($sentAt);
            }
        }

        return false;
    }
}
