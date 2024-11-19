# VIVAHR PHP SDK

A PHP SDK for integrating with the VIVAHR API, supporting job posting, candidate management, and more.

## Installation

To install the VIVAHR PHP SDK, ensure you have Composer installed. Then, run the following command:

```bash
composer require vivahr/vivahr-php
```

## Requirements

Make sure you have:

- PHP 7.0 or higher
- Composer

## Usage

Here’s how to initialize the SDK and perform various operations:

```php
require 'vendor/autoload.php';
```

### Step 1: Authenticate and get an access token

```php
use VIVAHR\Auth\Authentication;

$client_id = 'XXXXXXXXXX';
$client_secret = 'XXXXXXXXXXXXXXXX';

// Use this for Production
$api_url = 'https://auth.vivahr.com';

// Use this for Sandbox testing
$api_url = 'https://api-sandbox.vivahr.com';

$auth_token_path = '/oauth/token';

$auth = new Authentication($client_id , $client_secret, $api_url . $auth_token_path);
$accessTokenData = $auth->generateAccessToken();
$accessToken = $accessTokenData['access_token'];
```
  
### Step 2: Initialize the client

```php
use VIVAHR\Clients\VivahrClient;

$vivahrClient = new VivahrClient($accessToken, $api_url);
```

### Now you can make calls to the endpoints

```php

$jobs = $vivahrClient->jobs()->list([
    "offset"=> "",
    "limit"=> "",
    "keyword"=> "",
    "department_id"=> "",
    "location_id"=> "",
    "sort_field"=> "",
    "sort_direction"=> "",
    "hide_inactive"=> ""
]);
echo json_encode($jobs);
```

## Available Endpoints

### Jobs 
The Jobs endpoint allows you to manage job postings within the VIVAHR API. You can create, retrieve, update, close, and delete job postings. Below are the available methods:

### Job Helpers
Utilize helper methods to assist in job-related functionalities.

### Candidates
Handle candidate information such as creating new candidates, updating existing records, and retrieving candidate details.

### Candidate Notes
Manage notes related to candidates, allowing for tracking of interactions and observations.

### Compliance
Access compliance-related functionalities to ensure that your hiring practices adhere to relevant regulations.

### Disposition Reasons
Manage reasons for candidate dispositions, facilitating organized feedback and tracking.

### Departments
Interact with departments within your organization for job postings and candidate tracking.

### Locations
Manage and retrieve location information for job postings and candidate applications.

### Team Members
Handle information related to team members who participate in the hiring process.

### Embed Careers
Embed career opportunities into your website or platform, allowing candidates to apply directly.

### Pipeline Stages
Manage the various stages of the candidate pipeline throughout the hiring process.

### Scorecards
Utilize scorecards for evaluating candidates during the interview and hiring process.

### Email Templates
Manage various templates used in job postings, emails, and other communications.

### SMS Templates
Manage various templates used in job postings, emails, and other communications.

### Offer Templates
Manage various templates used in job postings, emails, and other communications.

### Job Description Templates
Manage various templates used in job postings, emails, and other communications.

### System Templates
Manage various templates used in job postings, emails, and other communications.

### Culture Profiles
Access and manage culture profiles to help candidates understand your organization's culture.

### Questionnaires
Create and manage questionnaires for candidates to gather more detailed information.

### Candidate Tags
Utilize tags to organize and categorize candidates for easier management.

### Helpers
Access helper functions that assist with various functionalities across the SDK.

### Reporting Issues

Found a bug or have a suggestion? Please [open an issue](https://github.com/c-alen/vivahr-php/issues) on our GitHub repository.

## Versioning

This SDK follows Semantic Versioning. Check the [changelog](https://github.com/c-alen/vivahr-php/releases) for updates.

## Documentation

For detailed API specifications, visit the [VIVAHR API Documentation](https://developer.vivahr.com).

## Error Handling

This SDK provides a custom ApiException class for handling API-related errors. You can catch this exception to handle errors gracefully:

```php
try {
    // Your API call here
} catch (\VIVHAR\Exceptions\ApiException $e) {
    echo "Error: " . $e->getMessage();
}
```

## Contributing

Contributions are welcome! Please submit a pull request or open an issue for any enhancements, bug fixes, or suggestions. Make sure to follow the coding standards and include tests for new features.

## License

This project is licensed under the MIT License. See the LICENSE file for details.