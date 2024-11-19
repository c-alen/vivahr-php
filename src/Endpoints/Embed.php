<?php

namespace VIVAHR\Endpoints;

use VIVAHR\HttpClient\Client;

class Embed
{
    private $client;
    private $endpoint;

    public function __construct(Client $client, string $endpoint)
    {
        $this->client = $client;
        $this->endpoint = $endpoint;
    }

    public function career_page_jobs()
    {
        return $this->client->request('GET', "{$this->endpoint}/career-jobs");
    }

    public function career_page()
    {
        return $this->client->request('GET', "{$this->endpoint}/jobs");
    }
}