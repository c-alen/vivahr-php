<?php

namespace VIVAHR\Endpoints;

use VIVAHR\HttpClient\Client;

class Candidates
{
    private $client;
    private $endpoint;

    public function __construct(Client $client, string $endpoint)
    {
        $this->client = $client;
        $this->endpoint = $endpoint;
    }

    /**
     * Creates a new candidate with the specified details.
     *
     * @param array $data The candidate details, including name, email, and any required fields.
     * @return array The API response with details of the newly created candidate.
     */
    public function create(array $data)
    {
        return $this->client->request('POST', $this->endpoint, ['multipart' => $data]);
    }

    /**
     * Updates an existing candidate by ID with new information.
     *
     * @param string $id The unique ID of the candidate to update.
     * @param array $data The updated candidate details.
     * @return array The API response with details of the updated candidate.
     */
    public function update($id, array $data)
    {
        return $this->client->request('PUT', "{$this->endpoint}/{$id}", ['form_params' => $data]);
    }

    /**
     * Retrieves details of a specific candidate by ID.
     *
     * @param string $id The unique ID of the candidate to retrieve.
     * @return array The candidate details as provided by the API.
     */
    public function get($id)
    {
        return $this->client->request('GET', "{$this->endpoint}/{$id}");
    }

    /**
     * Retrieves a list of candidates, optionally filtered by various parameters.
     *
     * @param array $data Filters and pagination options, such as 'offset', 'limit', and other criteria.
     * @return array A list of candidates matching the specified criteria.
     */
    public function list(array $data)
    {
        return $this->client->request('GET', $this->endpoint, ['json' => $data] );
    }

    /**
     * Shares a candidate's profile internally by ID with specific parameters.
     *
     * @param string $id The unique ID of the candidate to share internally.
     * @param array $data Parameters for internal sharing, such as team members or departments.
     * @return array The API response confirming the candidate has been shared.
     */
    public function share_internal($id, array $data)
    {
        return $this->client->request('POST', "{$this->endpoint}/{$id}/share/internal", ['form_params' => $data]);
    }

    /**
     * Shares a candidate's profile via email with specific parameters.
     *
     * @param string $id The unique ID of the candidate to share via email.
     * @param array $data Parameters for email sharing, such as recipient email and message.
     * @return array The API response confirming the candidate has been shared via email.
     */
    public function share_email($id, array $data)
    {
        return $this->client->request('POST', "{$this->endpoint}/{$id}/share/email", ['form_params' => $data]);
    }

    /**
     * Generates a public link to share the candidate’s profile.
     *
     * @param string $id The unique ID of the candidate to share by link.
     * @param array $data Additional parameters for generating the shareable link.
     * @return array The API response containing the shareable link.
     */
    public function share_link($id, array $data)
    {
        return $this->client->request('POST', "{$this->endpoint}/{$id}/share/link", ['form_params' => $data]);
    }

    /**
     * Sends a questionnaire to a candidate by ID with specified questions or content.
     *
     * @param string $id The unique ID of the candidate to send the questionnaire to.
     * @param array $data The questionnaire content or parameters.
     * @return array The API response confirming the questionnaire has been sent.
     */
    public function send_questionnaire($id, array $data)
    {
        return $this->client->request('POST', "{$this->endpoint}/{$id}/send-questionnaire", ['form_params' => $data]);
    }

    /**
     * Declines a candidate by ID, providing a reason or status update.
     *
     * @param string $id The unique ID of the candidate to decline.
     * @param array $data The parameters for declining the candidate, such as reason.
     * @return array The API response confirming the candidate has been declined.
     */
    public function decline($id, array $data)
    {
        return $this->client->request('POST', "{$this->endpoint}/{$id}/decline", ['form_params' => $data]);
    }

    /**
     * Retrieves a list of available status stages for a specific candidate.
     *
     * @param string $id The unique ID of the candidate.
     * @return array The API response containing available status stages for the candidate.
     */
    public function status_stages($id)
    {
        return $this->client->request('POST', "{$this->endpoint}/{$id}/status-stages");
    }

    /**
     * Sets the status stage of a candidate by ID to a specified stage.
     *
     * @param string $id The unique ID of the candidate.
     * @param array $data The new status stage details.
     * @return array The API response confirming the status stage has been updated.
     */
    public function set_status_stage($id, array $data)
    {
        return $this->client->request('POST', "{$this->endpoint}/{$id}/set-status", ['form_params' => $data]);
    }

    /**
     * Adds a tag to a candidate by ID to categorize or label them.
     *
     * @param string $id The unique ID of the candidate.
     * @param array $data The tag details to add to the candidate.
     * @return array The API response confirming the tag has been added.
     */
    public function add_tag($id, array $data)
    {
        return $this->client->request('POST', "{$this->endpoint}/{$id}/tag", ['form_params' => $data]);
    }

    /**
     * Deletes a candidate by ID, removing them from the system.
     *
     * @param string $id The unique ID of the candidate to delete.
     * @return array The API response confirming the candidate has been deleted.
     */
    public function delete($id)
    {
        return $this->client->request('DELETE', "{$this->endpoint}/{$id}");
    }
}