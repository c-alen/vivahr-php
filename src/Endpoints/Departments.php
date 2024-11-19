<?php

namespace VIVAHR\Endpoints;

use VIVAHR\HttpClient\Client;

class Departments
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
        return $this->client->request('POST', $this->endpoint, ['forma_params' => $data] );
    }

    public function update(int $id, array $data)
    {
        return $this->client->request('PUT', "{$this->endpoint}/{$id}", ['form_params' => $data]);
    }

    public function get(int $id)
    {
        return $this->client->request('GET', "{$this->endpoint}/{$id}");
    }

    public function list(array $data)
    {
        return $this->client->request('GET', $this->endpoint, ['json' => $data]);
    }

    public function delete(int $id)
    {
        return $this->client->request('DELETE', "{$this->endpoint}/{$id}");
    }
}