<?php

namespace App\Support;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Arr;
use Symfony\Contracts\HttpClient\ResponseInterface;

class LtpHttpClient extends HttpClient
{
    /**
     * @var array
     */
    protected $config;

    public function __construct()
    {
        $this->config = config('ltp.api');
    }

    public function sendDocuments(string $xml, string $documentName)
    {
        $headers = [
            'Content-Type' => 'text/xml; charset=UTF8'
        ];

        return $this->apiCall('post', $this->getSendDocumentsQuery($documentName), [
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

    protected function getSendDocumentsQuery(string $documentName)
    {
        return Arr::query([
            'sourceidentifier' => $this->config['private_key'],
            'targetidentifier' => $this->config['public_key'],
            'filenamehint' => "{$documentName}.xml",
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
            /** @var ResponseInterface $response */
            $response = $this->$type($url, $data, $headers);

            return [
                'code'=> $response->getStatusCode(),
                'body' => $this->parseJsonResponse($response)
            ];
        } catch (RequestException $e) {
            return [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }
    }
}
