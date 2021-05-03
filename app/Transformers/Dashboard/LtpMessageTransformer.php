<?php

namespace App\Transformers\Dashboard;

use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;
use Illuminate\Support\Arr;

/**
 * LtpMessage transformer.
 *
 * @package App\Transformers\Dashboard
 */
class LtpMessageTransformer implements TransformerContract
{
    use Collector;

    /**
     * @param Request $request
     * @return array
     */
    public static function transformStoreRequest(Request $request)
    {
        return [
            'sender_identifier' => $request->get('sender_identifier'),
            'sender_description' => $request->get('sender_description'),
            'filename_hint' => $request->get('filename_hint'),
            'content' => $request->get('content'),


        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public static function transformUpdateRequest(Request $request)
    {
        return [
            'sender_identifier' => $request->get('sender_identifier'),
            'sender_description' => $request->get('sender_description'),
            'filename_hint' => $request->get('filename_hint'),
            'content' => $request->get('content'),


        ];
    }

    /**
     * @param \App\LtpMessage $ltpMessage
     * @return array
     */
    public static function toArray($ltpMessage)
    {
        return [
            'id' => (int)$ltpMessage->getKey(),
            'sender_identifier' => $ltpMessage->sender_identifier,
            'sender_description' => $ltpMessage->sender_description,
            'filename_hint' => $ltpMessage->filename_hint,
            'content' => $ltpMessage->content,


            'created_at' => (string)$ltpMessage->created_at,
            'updated_at' => (string)$ltpMessage->updated_at,
            'deleted_at' => (string)$ltpMessage->deleted_at,
        ];
    }

    /**
     * @param array $response
     * @return array
     */
    public static function responseToLtpMessage(array $response)
    {
        return [
            'sender_identifier' => Arr::get($response, 'SenderIdentifier'),
            'sender_description' => Arr::get($response, 'SenderDescription'),
            'filename_hint' => Arr::get($response, 'FilenameHint'),
            'content' => Arr::get($response, 'Contents'),
        ];
    }
}
