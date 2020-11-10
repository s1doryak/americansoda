<?php

namespace App\Support;

use App\Exceptions\UnknownRequestMethodException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use Psr\Http\Message\ResponseInterface;

abstract class HttpClient
{
    /**
     * @var array
     */
    protected $options;

    /**
     * @param $url
     * @param null $data
     * @param array $headers
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function sendGet($url, $data = null, $headers = [])
    {
        return $this->send('get', $url, $data, $headers);
    }

    /**
     * @param $url
     * @param null $data
     * @param array $headers
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function sendPost($url, $data = null, $headers = [])
    {
        return $this->send('post', $url, $data, $headers);
    }

    /**
     * @param $url
     * @param null $data
     * @param array $headers
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function sendPut($url, $data = null, $headers = [])
    {
        return $this->send('put', $url, $data, $headers);
    }

    /**
     * @param $response
     * @return mixed
     */
    public function parseJsonResponse($response)
    {
        $stringResponse = (string)$response->getBody();

        return json_decode($stringResponse, true);
    }

    /**
     * @param $method
     * @param $url
     * @param null $data
     * @param array $headers
     * @return ResponseInterface
     * @throws GuzzleException
     */
    protected function send($method, $url, $data = null, $headers = [])
    {
        $client = new Client();
        $this->setOptions($headers);
        $this->setData($method, $headers, $data);

        switch ($method) {
            case 'get' :
                $response = $client->get($url, $this->options);
                break;
            case 'post' :
                $response = $client->post($url, $this->options);
                break;
            case 'put' :
                $response = $client->put($url, $this->options);
                break;
            case 'patch' :
                $response = $client->patch($url, $this->options);
                break;
            case 'delete' :
                $response = $client->delete($url, $this->options);
                break;
            default :
                throw app(UnknownRequestMethodException::class)->setMethod($method);
        }

        return $response;
    }

    /**
     * @param array $headers
     */
    protected function setOptions($headers)
    {
        $this->options = [];

        $this->options['headers'] = $headers;
    }

    /**
     * @param string $method
     * @param array $headers
     * @param array $data
     */
    protected function setData($method, $headers, $data = [])
    {
        $contentType = $this->getContentType($headers);

        if ($method == 'get') {
            $this->options['query'] = $data;
            return;
        }

        if (preg_match('/application\/json/', $contentType)) {
            $this->options['json'] = $data;
            return;
        }

        $this->options['form_params'] = $data;
    }

    protected function getContentType($headers)
    {
        $contentTypes = array_filter($headers, function ($name) {
            return in_array($name, ['Content-Type', 'content-type', 'CONTENT-TYPE']);
        }, ARRAY_FILTER_USE_KEY);

        return Arr::first($contentTypes);
    }

}
