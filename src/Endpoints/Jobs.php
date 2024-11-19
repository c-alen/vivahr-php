<?php

namespace VIVAHR\Endpoints;

use VIVAHR\HttpClient\Client;

class Jobs
{
    private $client;
    private $endpoint;

    public function __construct(Client $client, string $endpoint)
    {
        $this->client = $client;
        $this->endpoint = $endpoint;
    }

    /**
     * Creates a new job posting with the specified parameters.
     *
     * @param array $data The parameters for the job, such as job title, type, location, etc.
     * @return array The API response with details of the created job.
     */
    public function create(array $data)
    {
        return $this->client->request('POST', "{$this->endpoint}", ['form_params' => $data]);
    }

    /**
     * Updates an existing job posting by ID with the specified parameters.
     *
     * @param string $id The unique ID of the job to update.
     * @param array $data The updated job parameters.
     * @return array The API response with details of the updated job.
     */
    public function update($id, array $data)
    {
        return $this->client->request('PUT', "{$this->endpoint}/{$id}", ['form_params' => $data]);
    }

    /**
     * Retrieves details of a specific job by its unique ID.
     *
     * @param string $id The unique ID of the job to retrieve.
     * @return array The job details as provided by the API.
     */
    public function get($id)
    {
        return $this->client->request('GET', "{$this->endpoint}/{$id}");
    }

    /**
     * Retrieves a list of jobs, optionally filtered by various parameters.
     *
     * @param array $data Filters and pagination options, such as 'offset', 'limit', 'keyword', 'department_id', etc.
     * @return array A list of jobs matching the specified criteria.
     */
    public function list(array $data)
    {
        return $this->client->request('GET', "{$this->endpoint}", ['json' => $data]);
    }

    /**
     * Saves a job posting as a draft, allowing for further edits before publishing.
     *
     * @param array $data The job parameters to save as a draft.
     * @return array The API response with details of the saved draft job.
     */
    public function saveDraft(array $data)
    {
        return $this->client->request('POST', "{$this->endpoint}/draft", ['form_params' => $data]);
    }

    /**
     * Refreshes a job posting to update visibility or to re-activate it.
     *
     * @param string $id The unique ID of the job to refresh.
     * @param array $data Optional parameters to refresh, such as visibility or other settings.
     * @return array The API response confirming the job has been refreshed.
     */
    public function refreshJob($id, array $data)
    {
        return $this->client->request('PATCH', "{$this->endpoint}/{$id}", ['form_params' => $data]);
    }

    /**
     * Closes a job posting by ID, making it no longer available for applicants.
     *
     * @param string $id The unique ID of the job to close.
     * @return array The API response confirming the job has been closed.
     */
    public function close($id)
    {
        return $this->client->request('POST', "{$this->endpoint}/{$id}/close");
    }

    /**
     * Pauses a job posting by ID, temporarily stopping it from accepting applications.
     *
     * @param string $id The unique ID of the job to pause.
     * @return array The API response confirming the job has been paused.
     */
    public function pause($id)
    {
        return $this->client->request('POST', "{$this->endpoint}/{$id}/pause");
    }

    /**
     * Resumes a paused job posting by ID, allowing it to accept applications again.
     *
     * @param string $id The unique ID of the job to unpause.
     * @return array The API response confirming the job has been unpaused.
     */
    public function unpause($id)
    {
        return $this->client->request('POST', "{$this->endpoint}/{$id}/unpause");
    }

    /**
     * Shares a job posting via a specified source, such as a social media platform.
     *
     * @param string $id The unique ID of the job to share.
     * @param array $data The parameters for sharing, including the source (e.g., 'facebook').
     * @return array The API response confirming the job has been shared.
     */
    public function share($id, array $data)
    {
        return $this->client->request('POST', "{$this->endpoint}/{$id}/share", ['form_params' => $data]);
    }

    /**
     * Deletes a job posting by ID, permanently removing it from the system.
     *
     * @param string $id The unique ID of the job to delete.
     * @return array The API response confirming the job has been deleted.
     */
    public function delete($id)
    {
        return $this->client->request('DELETE', "{$this->endpoint}/{$id}");
    }
}