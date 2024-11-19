<?php

namespace VIVAHR\Endpoints;

use VIVAHR\HttpClient\Client;

class CultureProfile
{
    private $client;
    private $endpoint;

    public function __construct(Client $client, string $endpoint)
    {
        $this->client = $client;
        $this->endpoint = $endpoint;
    }

    public function create(array $data)
    {
        return $this->client->request('POST', $this->endpoint, ['form_params' => $data]);
    }

    public function get(int $id)
    {
        return $this->client->request('GET', "{$this->endpoint}/{$id}");
    }

    public function list()
    {
        return $this->client->request('GET', $this->endpoint);
    }

    public function delete(int $id)
    {
        return $this->client->request('DELETE', "{$this->endpoint}/{$id}");
    }
}