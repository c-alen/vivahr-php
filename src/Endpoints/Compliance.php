<?php

namespace VIVAHR\Endpoints;

use VIVAHR\HttpClient\Client;

class Compliance
{
    private $client;
    private $endpoint;

    public function __construct(Client $client, string $endpoint)
    {
        $this->client = $client;
        $this->endpoint = $endpoint;
    }

    public function list()
    {
        return $this->client->request('GET', $this->endpoint);
    }

    public function eeo_survey(array $data)
    {
        return $this->client->request('PATCH', "{$this->endpoint}eeo-survey", ['form_params' => $data]);
    }
}