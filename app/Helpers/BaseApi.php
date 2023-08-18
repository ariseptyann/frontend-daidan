<?php

namespace App\Helpers;

use GuzzleHttp\Client;

class BaseApi
{
    protected $client;

    public function __construct($client = null)
    {
        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => env('API_URL')
        ]);
    }

    public function get($endpoint, array $contents = [])
    {
        return $this->client->request('GET', $endpoint, $contents);
    }

    public function post($endpoint, array $contents = [])
    {
        return $this->client->request('POST', $endpoint, $contents);
    }

    public function put($endpoint, array $contents = [])
    {
        return $this->client->request('PUT', $endpoint, $contents);
    }
}
