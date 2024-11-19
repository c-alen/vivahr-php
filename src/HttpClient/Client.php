<?php

namespace VIVAHR\HttpClient;

use GuzzleHttp\Client as GuzzleClient;

class Client
{
    private $client;
    private $baseUrl;

    public function __construct($authToken, $baseUrl)
    {
        $this->client = new GuzzleClient([
            'base_uri' => rtrim($baseUrl, '/') . '/',
            'headers' => [
                'Authorization' => 'Bearer ' . $authToken,
                'Accept' => 'application/json',
            ],
        ]);

        $this->baseUrl = $baseUrl;
    }

    public function request($method, $uri, $options = [])
    {
        $response = $this->client->request($method, $uri, $options);
        return json_decode($response->getBody(), true);
    }

    public function getBaseUrl()
    {
        return $this->baseUrl;
    }
}