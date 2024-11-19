<?php

namespace VIVAHR\Endpoints;

use VIVAHR\HttpClient\Client;

class Helpers
{
    private $client;
    private $endpoint;

    public function __construct(Client $client, string $endpoint)
    {
        $this->client = $client;
        $this->endpoint = $endpoint;
    }

    public function listCountries()
    {
        return $this->client->request('GET', $this->endpoint.'/countries');
    }

    public function listStates()
    {
        return $this->client->request('GET', $this->endpoint.'/states');
    }
}