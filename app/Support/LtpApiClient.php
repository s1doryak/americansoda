<?php

namespace App\Support;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Arr;

class LtpApiClient extends HttpClient
{
    /**
     * @var array
     */
    protected $config;

    public function __construct()
    {
        $this->config = config('');
    }

    public function sendDocuments(string $xml)
    {
        $headers = [
            'Content-Type' => 'text/xml; charset=UTF8'
        ];

        return $this->apiCall('post', $this->getSendDocumentsQuery(), [
            'body' => $xml
        ], $headers);
    }

    public function checkDocuments()
    {
        $headers = [
            'Accept' => 'application/json, text/json'
        ];

        return $this->apiCall('get', $this->getCheckDocumentsQuery(), [], $headers);
    }

    protected function getSendDocumentsQuery()
    {
        return Arr::query([
            'sourceidentifier' => $this->config['private_key'],
            'targetidentifier' => $this->config['public_key'],
            'filenamehint' => 'document.xml',
        ]);
    }

    protected function getCheckDocumentsQuery()
    {
        return Arr::query([
            'targetidentifier' => $this->config['public_key'],
        ]);
    }

    protected function apiCall($type, $params, $data = [], $headers = [])
    {
        $type = "send{$type}";
        $url = sprintf('%s?%s', $this->config['base'], $params);

        try {
            return $this->parseJsonResponse($this->$type($url, $data, $headers));
        } catch (RequestException $e) {
            return [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }
    }
}
