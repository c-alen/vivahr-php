<?php

namespace VIVAHR\Endpoints;

use VIVAHR\HttpClient\Client;

class JobHelpers
{
    private $client;
    private $endpoint;

    public function __construct(Client $client, string $endpoint)
    {
        $this->client = $client;
        $this->endpoint = $endpoint;
    }

    public function listPositionTypes()
    {
        return $this->client->request('GET', "{$this->endpoint}/position_type");
    }

    public function listSkillLevels()
    {
        return $this->client->request('GET', "{$this->endpoint}/skill_level");
    }

    public function listVisibility()
    {
        return $this->client->request('GET', "{$this->endpoint}/visibility");
    }

    public function listCompanyIndustry()
    {
        return $this->client->request('GET', "{$this->endpoint}/company_industry");
    }

    public function listJobFunctions()
    {
        return $this->client->request('GET', "{$this->endpoint}/job_functions");
    }

    public function listLocationOptions()
    {
        return $this->client->request('GET', "{$this->endpoint}/remote");
    }

    public function listSalaryType()
    {
        return $this->client->request('GET', "{$this->endpoint}/salary_type");
    }
}