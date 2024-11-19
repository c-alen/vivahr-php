<?php

namespace VIVAHR;

use VIVAHR\Exceptions\ApiException;
use VIVAHR\Auth\Authentication;

use VIVAHR\Endpoints\Jobs;
use VIVAHR\Endpoints\JobHelpers;
use VIVAHR\Endpoints\Candidates;
use VIVAHR\Endpoints\CandidateNotes;
use VIVAHR\Endpoints\DispositionReasons;
use VIVAHR\Endpoints\Compliance;
use VIVAHR\Endpoints\Departments;
use VIVAHR\Endpoints\Locations;
use VIVAHR\Endpoints\TeamMembers;
use VIVAHR\Endpoints\Embed;
use VIVAHR\Endpoints\Pipelines;
use VIVAHR\Endpoints\PipelineStages;
use VIVAHR\Endpoints\Scorecards;
use VIVAHR\Endpoints\EmailTemplates;
use VIVAHR\Endpoints\SmsTemplates;
use VIVAHR\Endpoints\OfferTemplates;
use VIVAHR\Endpoints\JobDescriptionTemplates;
use VIVAHR\Endpoints\SystemEmailTemplates;
use VIVAHR\Endpoints\CultureProfile;
use VIVAHR\Endpoints\Questionnaires;
use VIVAHR\Endpoints\Tags;
use VIVAHR\Endpoints\Helpers;

class VivahrClient
{
    private $httpClient;
    private $apiPath = '/v1/';
    private $auth;
    private $baseUrl;

    public function __construct(string $accessToken, string $baseUrl)
    {
        if (empty($accessToken) || empty($baseUrl)) {
            throw new ApiException("Access token and base URL are required to initialize VivahrClient.");
        }

        $this->httpClient = new \VIVAHR\HttpClient\Client($accessToken, rtrim($baseUrl, '/'));

        $this->baseUrl = rtrim($baseUrl, '/');
        $this->auth = new Authentication(null, null, null, $accessToken);
    }

    private function getApiUrl(string $endpoint): string
    {
        return $this->httpClient->getBaseUrl() . $this->apiPath . $endpoint;
    }
    
    public function getAccessTokenData($accessToken)
    {
        return $this->auth->getAccessTokenData($this->baseUrl, $accessToken);
    }

    // Endpoint Accessors
    public function jobs()
    {
        return new Jobs($this->httpClient, $this->getApiUrl('jobs'));
    }

    public function jobHelpers()
    {
        return new JobHelpers($this->httpClient, $this->getApiUrl('job-helpers'));
    }

    public function candidates()
    {
        return new Candidates($this->httpClient, $this->getApiUrl('candidates'));
    }

    public function candidateNotes()
    {
        return new CandidateNotes($this->httpClient, $this->getApiUrl('candidates'));
    }

    public function dispositionReasons()
    {
        return new DispositionReasons($this->httpClient, $this->getApiUrl('disposition-reasons'));
    }

    public function compliance()
    {
        return new Compliance($this->httpClient, $this->getApiUrl('compliance'));
    }

    public function departments()
    {
        return new Departments($this->httpClient, $this->getApiUrl('departments'));
    }

    public function locations()
    {
        return new Locations($this->httpClient, $this->getApiUrl('locations'));
    }

    public function teamMembers()
    {
        return new TeamMembers($this->httpClient, $this->getApiUrl('team-members'));
    }

    public function embed()
    {
        return new Embed($this->httpClient, $this->getApiUrl('embed'));
    }

    public function pipelines()
    {
        return new Pipelines($this->httpClient, $this->getApiUrl('pipelines'));
    }

    public function pipelineStages()
    {
        return new PipelineStages($this->httpClient, $this->getApiUrl('pipeline-stages'));
    }

    public function scorecards()
    {
        return new Scorecards($this->httpClient, $this->getApiUrl('scorecards'));
    }

    public function emailTemplates()
    {
        return new EmailTemplates($this->httpClient, $this->getApiUrl('email-templates'));
    }

    public function smsTemplates()
    {
        return new SmsTemplates($this->httpClient, $this->getApiUrl('sms-templates'));
    }

    public function offerTemplates()
    {
        return new OfferTemplates($this->httpClient, $this->getApiUrl('offer-templates'));
    }

    public function jobDescriptionTemplates()
    {
        return new JobDescriptionTemplates($this->httpClient, $this->getApiUrl('job-description-templates'));
    }

    public function systemEmailTemplates()
    {
        return new SystemEmailTemplates($this->httpClient, $this->getApiUrl('system-email-templates'));
    }

    public function cultureProfile()
    {
        return new CultureProfile($this->httpClient, $this->getApiUrl('culture-profile'));
    }

    public function questionnaires()
    {
        return new Questionnaires($this->httpClient, $this->getApiUrl('questionnaires'));
    }

    public function tags()
    {
        return new Tags($this->httpClient, $this->getApiUrl('tags'));
    }

    public function helpers()
    {
        return new Helpers($this->httpClient, $this->getApiUrl('helpers'));
    }
}