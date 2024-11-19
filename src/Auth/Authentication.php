<?php

namespace VIVAHR\Auth;

use GuzzleHttp\Client;
use VIVAHR\Exceptions\ApiException;

class Authentication
{
    private $clientId;
    private $clientSecret;
    private $tokenUrl;
    private $accessToken;

    public function __construct($clientId = null, $clientSecret = null, $tokenUrl = null, $accessToken = null)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->tokenUrl = $tokenUrl;
        $this->accessToken = $accessToken;
    }

    /**
     * Generates a new access token using client credentials.
     *
     * @return array The token data.
     * @throws ApiException If token generation fails.
     */
    public function generateAccessToken()
    {
        $client = new Client();
        $response = $client->post($this->tokenUrl, [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        if (!isset($data['access_token'])) {
            throw new ApiException("Failed to retrieve access token.");
        }

        $this->accessToken = $data;
        return $this->accessToken;
    }

    /**
     * Gets the current access token.
     *
     * @return string The access token.
     * @throws ApiException If the access token is not available.
     */
    public function getAccessToken()
    {
        if (empty($this->accessToken)) {
            throw new ApiException("Access token not available.");
        }

        return $this->accessToken;
    }

    public function getAccessTokenData($url, $accessToken)
    {
        $client = new Client();
    
        try {
            $response = $client->get($url . '/oauth/verify', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
            ]);
    
            $data = json_decode($response->getBody(), true);
    
            if (isset($data['status']) && $data['status'] === 'success') {
                return $data['token_data']; // Return only token data if verification is successful
            } else {
                throw new \Exception('Token verification failed: ' . ($data['message'] ?? 'Unknown error'));
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Handle HTTP errors
            $responseBody = $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : 'No response';
            throw new \Exception('HTTP Request failed: ' . $responseBody);
        } catch (\Exception $e) {
            // Handle general exceptions
            throw new \Exception('An error occurred: ' . $e->getMessage());
        }
    }
}