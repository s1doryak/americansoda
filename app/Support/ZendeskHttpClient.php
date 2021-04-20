<?php

namespace App\Support;

use App\Repositories\Contracts\SettingRepository;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Str;

class ZendeskHttpClient extends HttpClient
{
    /**
     * @var SettingRepository
     */
    protected $settingRepository;

    protected $config;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
        $this->config = config('zendesk.api');
    }

    /**
     * @param string $name
     * @return array|mixed
     */
    public function createOrganization(string $name)
    {
        return $this->apiCall('post', '/organizations.json', [
            'organization' => compact('name')
        ]);
    }

    /**
     * @param string $id
     * @param array $update
     * @return array|mixed
     */
    public function updateOrganization(string $id, array $update)
    {
        return $this->apiCall('put', "/organizations/{$id}.json", [
            'organization' => $update
        ]);
    }

    public function getOrganizations()
    {
        return $this->apiCall('get', '/organizations.json');
    }

    protected function apiCall($type, $path, $data = [], $headers = [])
    {
        $type = "send{$type}";
        $url = $this->prepareUrl($path);

        $headers = array_merge($headers, [
            'Authorization' => 'Basic ' . base64_encode($this->config['email'] . ':' . $this->config['password']),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ]);

        try {
            return $this->parseJsonResponse($this->$type($url, $data, $headers));
        } catch (RequestException $e) {
            return [
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }
    }

    protected function prepareUrl($path)
    {
        $base = sprintf($this->config['base'], $this->config['subdomain']);

        return $base . $path;
    }
}
