<?php

namespace VIVAHR\Endpoints;

use VIVAHR\HttpClient\Client;

class CandidateNotes
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

    public function get($id)
    {
        return $this->client->request('GET', "{$this->endpoint}/{$id}");
    }

    public function list(array $data)
    {
        return $this->client->request('GET', $this->endpoint, ['json' => $data]);
    }

    public function delete($id)
    {
        return $this->client->request('DELETE', "{$this->endpoint}/{$id}");
    }
}