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
use VIVAHR\VivahrClient;

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

#### Available Methods

# Create Job Posting API Call

## **Purpose**
This API call is used to **create a new job posting** in the VIVAHR system. It sends job details to the server and returns a response confirming the creation or indicating any errors.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/jobs`
- **Method:** `POST`

---

## **Headers**
| **Header**           | **Value**                        | **Description**                            |
|-----------------------|----------------------------------|--------------------------------------------|
| `Content-Type`        | `application/x-www-form-urlencoded` | Specifies the format of the request payload. |
| `Authorization`       | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Payload**
Below are the fields included in the request payload:

| **Parameter**                               | **Type**     | **Required** | **Description**                                                                 |
|---------------------------------------------|--------------|--------------|---------------------------------------------------------------------------------|
| `job_title`                                 | `string`     | Yes          | The title of the job posting (e.g., "API DEVELOPER").                           |
| `job_type`                                  | `string`     | Yes          | The type of job (`1 = Full-time`, `2 = Part-time`).                             |
| `skill_level`                               | `string`     | Yes          | Required skill level (`1 = Beginner`, `5 = Expert`).                           |
| `remote_id`                                 | `string`     | Yes          | Indicates if the job is remote (`0 = No`, `1 = Yes`).                           |
| `location_id`                               | `string`     | Yes          | Location ID (e.g., `rem` for remote).                                           |
| `visibility_id`                             | `string`     | Yes          | Visibility (`1 = Public`, `2 = Private`).                                       |
| `salary_type`                               | `string`     | Yes          | Salary type (`hour`, `annual`, `monthly`).                                      |
| `salary_range[from]`                        | `string`     | Yes          | Minimum salary.                                                                 |
| `salary_range[to]`                          | `string`     | Yes          | Maximum salary.                                                                 |
| `industry`                                  | `string`     | Yes          | Industry ID.                                                                    |
| `department_id`                             | `string`     | Yes          | ID of the department the job belongs to.                                        |
| `job_functions[]`                           | `array`      | Yes          | Functions or roles associated with the job.                                     |
| `profile_id`                                | `string`     | Yes          | Profile ID associated with the job posting.                                     |
| `form_id`                                   | `string`     | Yes          | Application form ID for this job.                                               |
| `description`                               | `string`     | Yes          | Detailed description of the job posting.                                        |
| `hiring_team`                               | `string`     | Yes          | Hiring team ID responsible for the job.                                         |
| `pipeline_id`                               | `string`     | Yes          | Pipeline ID to track candidates for this job.                                   |
| `scorecard_id`                              | `string`     | Yes          | Scorecard ID used for evaluating candidates.                                    |
| `application_form[resume][required]`       | `string`     | No           | If the resume is required (`0 = No`, `1 = Yes`).                                |
| `application_form[resume][disabled]`       | `string`     | No           | If the resume is disabled (`0 = No`, `1 = Yes`).                                |
| `application_form[coverletter][required]`  | `string`     | No           | If the cover letter is required (`0 = No`, `1 = Yes`).                          |
| `application_form[coverletter][disabled]`  | `string`     | No           | If the cover letter is disabled (`0 = No`, `1 = Yes`).                          |
| `application_form[phone][required]`        | `string`     | No           | If the phone number is required (`0 = No`, `1 = Yes`).                          |
| `application_form[phone][disabled]`        | `string`     | No           | If the phone number is disabled (`0 = No`, `1 = Yes`).                          |
| `application_form[applicant_address][required]` | `string` | No           | If the address is required (`0 = No`, `1 = Yes`).                               |
| `application_form[applicant_address][disabled]` | `string` | No           | If the address is disabled (`0 = No`, `1 = Yes`).                               |
| `application_form[linkedin][required]`     | `string`     | No           | If LinkedIn is required (`0 = No`, `1 = Yes`).                                  |
| `application_form[linkedin][disabled]`     | `string`     | No           | If LinkedIn is disabled (`0 = No`, `1 = Yes`).                                  |
| `application_form[portfolio][required]`    | `string`     | No           | If a portfolio is required (`0 = No`, `1 = Yes`).                               |
| `application_form[portfolio][disabled]`    | `string`     | No           | If a portfolio is disabled (`0 = No`, `1 = Yes`).                               |
| `application_form[website][required]`      | `string`     | No           | If a website is required (`0 = No`, `1 = Yes`).                                 |
| `application_form[website][disabled]`      | `string`     | No           | If a website is disabled (`0 = No`, `1 = Yes`).                                 |
| `default_application_form`                 | `string`     | No           | If the default application form is used (`0 = No`, `1 = Yes`).                  |

---


# Update Job Posting API Call

## **Purpose**
This API call is used to **update an existing job posting** in the VIVAHR system. It modifies the job details by sending updated information to the server.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/jobs/:id`
- **Method:** `PUT`
- **Note:** Replace `:id` with the ID of the job you want to update.

---

## **Headers**
| **Header**           | **Value**                        | **Description**                            |
|-----------------------|----------------------------------|--------------------------------------------|
| `Content-Type`        | `application/x-www-form-urlencoded` | Specifies the format of the request payload. |
| `Authorization`       | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Payload**
Below are the fields included in the request payload:

| **Parameter**                               | **Type**     | **Required** | **Description**                                                                 |
|---------------------------------------------|--------------|--------------|---------------------------------------------------------------------------------|
| `job_title`                                 | `string`     | No           | The title of the job posting (e.g., "API DEVELOPER").                           |
| `job_type`                                  | `string`     | No           | The type of job (`1 = Full-time`, `2 = Part-time`).                             |
| `skill_level`                               | `string`     | No           | Required skill level (`1 = Beginner`, `5 = Expert`).                           |
| `remote_id`                                 | `string`     | No           | Indicates if the job is remote (`0 = No`, `1 = Yes`).                           |
| `location_id`                               | `string`     | No           | Location ID (e.g., `rem` for remote).                                           |
| `visibility_id`                             | `string`     | No           | Visibility (`1 = Public`, `2 = Private`).                                       |
| `salary_type`                               | `string`     | No           | Salary type (`hour`, `annual`, `monthly`).                                      |
| `salary_range[from]`                        | `string`     | No           | Minimum salary.                                                                 |
| `salary_range[to]`                          | `string`     | No           | Maximum salary.                                                                 |
| `industry`                                  | `string`     | No           | Industry ID.                                                                    |
| `department_id`                             | `string`     | No           | ID of the department the job belongs to.                                        |
| `job_functions[]`                           | `array`      | No           | Functions or roles associated with the job.                                     |
| `profile_id`                                | `string`     | No           | Profile ID associated with the job posting.                                     |
| `form_id`                                   | `string`     | No           | Application form ID for this job.                                               |
| `description`                               | `string`     | No           | Detailed description of the job posting.                                        |
| `hiring_team`                               | `string`     | No           | Hiring team ID responsible for the job.                                         |
| `pipeline_id`                               | `string`     | No           | Pipeline ID to track candidates for this job.                                   |
| `scorecard_id`                              | `string`     | No           | Scorecard ID used for evaluating candidates.                                    |
| `application_form[resume][required]`       | `string`     | No           | If the resume is required (`0 = No`, `1 = Yes`).                                |
| `application_form[resume][disabled]`       | `string`     | No           | If the resume is disabled (`0 = No`, `1 = Yes`).                                |
| `application_form[coverletter][required]`  | `string`     | No           | If the cover letter is required (`0 = No`, `1 = Yes`).                          |
| `application_form[coverletter][disabled]`  | `string`     | No           | If the cover letter is disabled (`0 = No`, `1 = Yes`).                          |
| `application_form[phone][required]`        | `string`     | No           | If the phone number is required (`0 = No`, `1 = Yes`).                          |
| `application_form[phone][disabled]`        | `string`     | No           | If the phone number is disabled (`0 = No`, `1 = Yes`).                          |
| `application_form[applicant_address][required]` | `string` | No           | If the address is required (`0 = No`, `1 = Yes`).                               |
| `application_form[applicant_address][disabled]` | `string` | No           | If the address is disabled (`0 = No`, `1 = Yes`).                               |
| `application_form[linkedin][required]`     | `string`     | No           | If LinkedIn is required (`0 = No`, `1 = Yes`).                                  |
| `application_form[linkedin][disabled]`     | `string`     | No           | If LinkedIn is disabled (`0 = No`, `1 = Yes`).                                  |
| `application_form[portfolio][required]`    | `string`     | No           | If a portfolio is required (`0 = No`, `1 = Yes`).                               |
| `application_form[portfolio][disabled]`    | `string`     | No           | If a portfolio is disabled (`0 = No`, `1 = Yes`).                               |
| `application_form[website][required]`      | `string`     | No           | If a website is required (`0 = No`, `1 = Yes`).                                 |
| `application_form[website][disabled]`      | `string`     | No           | If a website is disabled (`0 = No`, `1 = Yes`).                                 |
| `default_application_form`                 | `string`     | No           | If the default application form is used (`0 = No`, `1 = Yes`).                  |

---

# Retrieve Job Details API Call

## **Purpose**
This API call is used to **retrieve details of a specific job posting** from the VIVAHR system.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/jobs/:id`
- **Method:** `GET`
- **Note:** Replace `:id` with the unique ID of the job you want to fetch.

---

## **Headers**
| **Header**      | **Value**                 | **Description**                            |
|------------------|---------------------------|--------------------------------------------|
| `Authorization`  | `Bearer YOUR_ACCESS_TOKEN` | A valid access token for authentication.    |

---

# Retrieve Job Listings API Call

## **Purpose**
This API call is used to **fetch a list of job postings** from the VIVAHR system. It supports filtering, sorting, and pagination.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/jobs`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                 | **Description**                            |
|------------------|---------------------------|--------------------------------------------|
| `Content-Type`   | `application/json`       | Specifies the media type of the resource.  |
| `Authorization`  | `Bearer YOUR_ACCESS_TOKEN` | A valid access token for authentication.    |

---

## **Request Body**
The request body is a JSON object that allows you to filter, paginate, and sort job listings.

### **Parameters**
| **Parameter**     | **Type**  | **Description**                                                             | **Example**     |
|--------------------|-----------|-----------------------------------------------------------------------------|-----------------|
| `offset`          | `string`  | The starting point for pagination.                                          | `"0"`           |
| `limit`           | `string`  | The maximum number of results to return.                                    | `"10"`          |
| `keyword`         | `string`  | A keyword to search for jobs (e.g., job title, description).                | `"developer"`   |
| `department_id`   | `string`  | Filter jobs by department ID.                                               | `"1234"`        |
| `location_id`     | `string`  | Filter jobs by location ID.                                                 | `"remote"`      |
| `sort_field`      | `string`  | Field by which to sort the results.                                         | `"created_at"`  |
| `sort_direction`  | `string`  | Sort direction (`asc` or `desc`).                                           | `"asc"`         |
| `hide_inactive`   | `string`  | Hide inactive jobs (`1` to hide, `0` to include inactive jobs).             | `"1"`           |

---

# Create Draft Job Posting API Call

## **Purpose**
This API call is used to **create a draft job posting** within the VIVAHR system. This draft job posting can later be reviewed, edited, and published as an active job.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/jobs/draft`
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                      | **Description**                             |
|-----------------|---------------------------------|---------------------------------------------|
| `Content-Type`  | `application/x-www-form-urlencoded` | Specifies the media type of the resource.  |
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
The request body is used to define the details of the draft job posting.

### **Parameters**

| **Parameter**                            | **Type**     | **Description**                                                              | **Example**  |
|------------------------------------------|--------------|------------------------------------------------------------------------------|--------------|
| `job_title`                              | `string`     | The title of the job posting.                                                 | `"API DEVELOPER"` |
| `job_type`                               | `string`     | Type of job (e.g., full-time, part-time).                                    | `"1"`        |
| `skill_level`                            | `string`     | The required skill level for the job.                                        | `"5"`        |
| `remote_id`                              | `string`     | Indicator if the job is remote. (`0` for no, `1` for yes).                   | `"0"`        |
| `location_id`                            | `string`     | The location identifier for the job.                                          | `"rem"`      |
| `visibility_id`                          | `string`     | Visibility of the job (`1` for public).                                      | `"1"`        |
| `salary_type`                            | `string`     | The type of salary for the job (`hour`, `annual`, etc.).                      | `"hour"`     |
| `salary_range[from]`                     | `string`     | The lower bound of the salary range.                                          | `"20"`       |
| `salary_range[to]`                       | `string`     | The upper bound of the salary range.                                          | `"30"`       |
| `industry`                               | `string`     | The industry ID for the job.                                                 | `"20"`       |
| `department_id`                          | `string`     | The department ID associated with the job.                                    | `"3404"`     |
| `job_functions[]`                        | `array`      | Array of job functions (e.g., `["1", "2"]`).                                 | `["1", "2"]` |
| `profile_id`                             | `string`     | The ID of the profile to associate with the job.                              | `"772"`      |
| `form_id`                                | `string`     | The form ID associated with the job application.                             | `"2922"`     |
| `description`                            | `string`     | A description of the job posting.                                            | `"Test Description"` |
| `hiring_team`                            | `string`     | The hiring team ID for the job posting.                                      | `"10280"`    |
| `pipeline_id`                            | `string`     | The pipeline ID associated with the job.                                     | `"4908"`     |
| `scorecard_id`                           | `string`     | The scorecard ID used for evaluating candidates.                             | `"2460"`     |
| `application_form[resume][required]`     | `string`     | Whether a resume is required for the application (`0` for no, `1` for yes).  | `"0"`        |
| `application_form[resume][disabled]`     | `string`     | Whether the resume field is disabled (`0` for no, `1` for yes).              | `"0"`        |
| `application_form[coverletter][required]`| `string`     | Whether a cover letter is required (`0` for no, `1` for yes).                | `"0"`        |
| `application_form[coverletter][disabled]`| `string`     | Whether the cover letter field is disabled (`0` for no, `1` for yes).        | `"0"`        |
| `application_form[phone][required]`      | `string`     | Whether a phone number is required (`0` for no, `1` for yes).                | `"0"`        |
| `application_form[phone][disabled]`      | `string`     | Whether the phone number field is disabled (`0` for no, `1` for yes).        | `"0"`        |
| `application_form[applicant_address][required]` | `string` | Whether the applicant's address is required (`0` for no, `1` for yes).       | `"0"`        |
| `application_form[applicant_address][disabled]` | `string` | Whether the applicant address field is disabled (`0` for no, `1` for yes).   | `"0"`        |
| `application_form[linkedin][required]`   | `string`     | Whether a LinkedIn profile is required (`0` for no, `1` for yes).            | `"0"`        |
| `application_form[linkedin][disabled]`   | `string`     | Whether the LinkedIn field is disabled (`0` for no, `1` for yes).            | `"0"`        |
| `application_form[portfolio][required]`  | `string`     | Whether a portfolio is required (`0` for no, `1` for yes).                   | `"0"`        |
| `application_form[portfolio][disabled]`  | `string`     | Whether the portfolio field is disabled (`0` for no, `1` for yes).           | `"0"`        |
| `application_form[website][required]`    | `string`     | Whether a website is required (`0` for no, `1` for yes).                     | `"0"`        |
| `application_form[website][disabled]`    | `string`     | Whether the website field is disabled (`0` for no, `1` for yes).             | `"0"`        |
| `default_application_form`               | `string`     | Whether this is the default application form (`1` for yes).                  | `"1"`        |

---

# Refresh a Job API Call

## **Purpose**
This API call is used to **refresh an existing job posting** in the VIVAHR system. The job posting can be updated with new information, such as job title, salary range, location, and more.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/jobs/:id`
  - Replace `:id` with the actual job ID to refresh the corresponding job posting.
- **Method:** `PATCH`

---

## **Headers**
| **Header**      | **Value**                      | **Description**                             |
|-----------------|---------------------------------|---------------------------------------------|
| `Content-Type`  | `application/x-www-form-urlencoded` | Specifies the media type of the resource.  |
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
The request body is used to define the details of the job posting to be refreshed. 

### **Parameters**

| **Parameter**                            | **Type**     | **Description**                                                              | **Example**  |
|------------------------------------------|--------------|------------------------------------------------------------------------------|--------------|
| `job_title`                              | `string`     | The title of the job posting.                                                 | `"API DEVELOPER"` |
| `job_type`                               | `string`     | Type of job (e.g., full-time, part-time).                                    | `"1"`        |
| `skill_level`                            | `string`     | The required skill level for the job.                                        | `"5"`        |
| `remote_id`                              | `string`     | Indicator if the job is remote. (`0` for no, `1` for yes).                   | `"0"`        |
| `location_id`                            | `string`     | The location identifier for the job.                                          | `"rem"`      |
| `visibility_id`                          | `string`     | Visibility of the job (`1` for public).                                      | `"1"`        |
| `salary_type`                            | `string`     | The type of salary for the job (`hour`, `annual`, etc.).                      | `"hour"`     |
| `salary_range[from]`                     | `string`     | The lower bound of the salary range.                                          | `"20"`       |
| `salary_range[to]`                       | `string`     | The upper bound of the salary range.                                          | `"30"`       |
| `industry`                               | `string`     | The industry ID for the job.                                                 | `"20"`       |
| `department_id`                          | `string`     | The department ID associated with the job.                                    | `"3404"`     |
| `job_functions[]`                        | `array`      | Array of job functions (e.g., `["1", "2"]`).                                 | `["1", "2"]` |
| `profile_id`                             | `string`     | The ID of the profile to associate with the job.                              | `"772"`      |
| `form_id`                                | `string`     | The form ID associated with the job application.                             | `"2922"`     |
| `description`                            | `string`     | A description of the job posting.                                            | `"Test Description"` |
| `hiring_team`                            | `string`     | The hiring team ID for the job posting.                                      | `"10280"`    |
| `pipeline_id`                            | `string`     | The pipeline ID associated with the job.                                     | `"4908"`     |
| `scorecard_id`                           | `string`     | The scorecard ID used for evaluating candidates.                             | `"2460"`     |
| `application_form[resume][required]`     | `string`     | Whether a resume is required for the application (`0` for no, `1` for yes).  | `"0"`        |
| `application_form[resume][disabled]`     | `string`     | Whether the resume field is disabled (`0` for no, `1` for yes).              | `"0"`        |
| `application_form[coverletter][required]`| `string`     | Whether a cover letter is required (`0` for no, `1` for yes).                | `"0"`        |
| `application_form[coverletter][disabled]`| `string`     | Whether the cover letter field is disabled (`0` for no, `1` for yes).        | `"0"`        |
| `application_form[phone][required]`      | `string`     | Whether a phone number is required (`0` for no, `1` for yes).                | `"0"`        |
| `application_form[phone][disabled]`      | `string`     | Whether the phone number field is disabled (`0` for no, `1` for yes).        | `"0"`        |
| `application_form[applicant_address][required]` | `string` | Whether the applicant's address is required (`0` for no, `1` for yes).       | `"0"`        |
| `application_form[applicant_address][disabled]` | `string` | Whether the applicant address field is disabled (`0` for no, `1` for yes).   | `"0"`        |
| `application_form[linkedin][required]`   | `string`     | Whether a LinkedIn profile is required (`0` for no, `1` for yes).            | `"0"`        |
| `application_form[linkedin][disabled]`   | `string`     | Whether the LinkedIn field is disabled (`0` for no, `1` for yes).            | `"0"`        |
| `application_form[portfolio][required]`  | `string`     | Whether a portfolio is required (`0` for no, `1` for yes).                   | `"0"`        |
| `application_form[portfolio][disabled]`  | `string`     | Whether the portfolio field is disabled (`0` for no, `1` for yes).           | `"0"`        |
| `application_form[website][required]`    | `string`     | Whether a website is required (`0` for no, `1` for yes).                     | `"0"`        |
| `application_form[website][disabled]`    | `string`     | Whether the website field is disabled (`0` for no, `1` for yes).             | `"0"`        |
| `default_application_form`               | `string`     | Whether this is the default application form (`1` for yes).                  | `"1"`        |
| `move_candidates`                        | `string`     | Whether to move candidates to the next stage in the hiring process (`1` for yes). | `"1"`     |

---

# Close a Job API Call

## **Purpose**
This API call is used to **close a job posting** in the VIVAHR system, meaning that no more candidates can apply for this job.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/jobs/:id/close`
  - Replace `:id` with the actual job ID to close the corresponding job posting.
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                      | **Description**                             |
|-----------------|---------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
There is no request body required for this API call. The job is simply closed by sending a `POST` request to the endpoint with the job ID.

---

# Pause a Job API Call

## **Purpose**
This API call is used to **pause a job posting**, making it inactive and preventing new candidates from applying for the job. The job remains in the system, but applications are not accepted during the paused state.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/jobs/:id/pause`
  - Replace `:id` with the actual job ID to pause the corresponding job posting.
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                      | **Description**                             |
|-----------------|---------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`      | A valid access token for authentication.    |

---

## **Request Body**
There is no request body required for this API call. The job is simply paused by sending a `POST` request to the endpoint with the job ID.

---

# Unpause a Job API Call

## **Purpose**
This API call is used to **unpause a previously paused job posting**, making it active again and allowing candidates to apply for the job.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/jobs/:id/unpause`
  - Replace `:id` with the actual job ID to unpause the corresponding job posting.
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                      | **Description**                             |
|-----------------|---------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`      | A valid access token for authentication.    |

---

## **Request Body**
There is no request body required for this API call. The job is simply unpaused by sending a `POST` request to the endpoint with the job ID.

---

# Share a Job API Call

## **Purpose**
This API call allows you to **share a job posting** on external platforms, such as LinkedIn. By sending the request, you can share a job posting with the specified source.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/jobs/:id/share`
  - Replace `:id` with the actual job ID to share the corresponding job posting.
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Specifies that the request body is encoded as `x-www-form-urlencoded`. |

---

## **Request Body**
The body of the request includes the following parameter:

| **Field** | **Type** | **Description**             | **Example** |
|-----------|----------|-----------------------------|-------------|
| `source`  | String   | The source platform where the job is shared. | `"linkedin"` |

---

This API will share the job to the specified platform (`linkedin` in this case). You can modify the `source` to match the platform you want to use.

# Delete a Job API Call

## **Purpose**
This API call allows you to **delete a job posting** from the VIVAHR system. Once the job is deleted, it is permanently removed and cannot be recovered.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/jobs/:id`
  - Replace `:id` with the actual job ID you wish to delete.
- **Method:** `DELETE`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Description**
- This request allows you to delete a specific job posting from the system using its `job_id`.
- Once deleted, the job posting is permanently removed from the VIVAHR platform.


### Job Helpers
Utilize helper methods to assist in job-related functionalities.

# Get Position Type Helper API Call

## **Purpose**
This API call allows you to retrieve the available **position types** for job postings from the VIVAHR platform. It provides a list of predefined position types that can be used when creating or updating job postings.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/job-helpers/position_type`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Description**
- This request fetches the list of available position types that can be assigned to a job.
- Position types refer to the various categories or classifications for roles, such as Full-Time, Part-Time, Internship, etc.

# Get Skill Level Helper API Call

## **Purpose**
This API call allows you to retrieve the available **skill levels** for job postings from the VIVAHR platform. It provides a list of predefined skill levels that can be assigned to job candidates.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/job-helpers/skill_level`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Description**
- This request fetches the list of available skill levels that can be assigned to a job.
- Skill levels are used to categorize job candidates based on their expertise or proficiency in the role, such as Beginner, Intermediate, or Expert.

# Get Visibility Helper API Call

## **Purpose**
This API call allows you to retrieve the available **visibility options** for job postings from the VIVAHR platform. It provides a list of predefined visibility settings that can be applied to job postings.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/job-helpers/visibility`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Description**
- This request fetches the list of available visibility options for job postings.
- Visibility settings are used to control how and to whom a job posting is visible on the VIVAHR platform. For example, you can set a job posting to be visible only to specific departments or to the public.

# Get Company Industry Helper API Call

## **Purpose**
This API call allows you to retrieve the available **company industry options** for job postings from the VIVAHR platform. It provides a list of predefined industries that can be associated with a job posting.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/job-helpers/company_industry`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Description**
- This request fetches the list of available industries for job postings.
- Industries are used to classify job postings by the type of business or sector, such as technology, healthcare, etc.

# Get Job Functions Helper API Call

## **Purpose**
This API call allows you to retrieve the available **job functions** for job postings on the VIVAHR platform. It provides a list of predefined job functions that can be associated with a job posting.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/job-helpers/job_functions`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Description**
- This request fetches the list of available job functions for job postings.
- Job functions represent the roles or tasks that a job entails, such as marketing, software development, or sales.

# Get Remote Job Options API Call

## **Purpose**
This API call allows you to retrieve the available options for **remote work** when creating or updating a job posting on the VIVAHR platform. It returns the different remote work types (e.g., fully remote, hybrid, etc.) that can be associated with a job.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/job-helpers/remote`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Description**
- This request fetches the available remote job options, which can be used when creating or updating job postings.
- It helps define whether a job is remote, hybrid, or requires in-office presence.

# Get Salary Type Options API Call

## **Purpose**
This API call retrieves the available **salary types** that can be assigned to a job posting. It helps to define how the salary for the position is structured (e.g., hourly, salary, commission-based, etc.).

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/job-helpers/salary_type`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Description**
- This request fetches the available salary types for job postings, which can be used to specify how compensation is structured for a particular role.
- It provides options like hourly, annual salary, commission-based pay, and more.


### Candidates
Handle candidate information such as creating new candidates, updating existing records, and retrieving candidate details.

<details>
  <summary>Click to expand: Create Candidate API Call</summary>

  ## **Purpose**
  This API call allows you to **create a new candidate** in the VIVAHR system. The candidate is added with their personal and contact details, along with the position they are applying for and the source of the application.

  ---

  ## **Endpoint**
  - **URL:** `https://auth.vivahr.com/v1/candidates`
  - **Method:** `POST`

  ---

  ## **Headers**
  | **Header**      | **Value**                       | **Description**                             |
  |-----------------|----------------------------------|---------------------------------------------|
  | `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
  | `Content-Type`  | `application/x-www-form-urlencoded` | The format of the request body.             |

  ---

  ## **Description**
  - This request creates a new candidate in the VIVAHR system by providing details such as their name, email, phone number, and position.
  - The `action` parameter is set to `"manual"`, indicating the candidate was added manually.
  - You can also specify social media profiles and the source of the candidate’s application.
  - The `position_id` corresponds to the job for which the candidate is being considered.
</details>
- **update($id, array $data):** Updates an existing candidate by ID with new information.  
  **Parameters:** The unique ID of the candidate to update and an associative array of updated details.  
  **Returns:** The API response with details of the updated candidate.

- **get($id):** Retrieves details of a specific candidate by ID.  
  **Parameters:** The unique ID of the candidate to retrieve.  
  **Returns:** The candidate details as provided by the API.

- **list(array $data):** Retrieves a list of candidates, optionally filtered by various parameters.  
  **Parameters:** Filters and pagination options, such as 'offset', 'limit', and other criteria.  
  **Returns:** A list of candidates matching the specified criteria.

- **share_internal($id, array $data):** Shares a candidate's profile internally by ID with specific parameters.  
  **Parameters:** The unique ID of the candidate to share internally and parameters for internal sharing, such as team members or departments.  
  **Returns:** The API response confirming the candidate has been shared.

- **share_email($id, array $data):** Shares a candidate's profile via email with specific parameters.  
  **Parameters:** The unique ID of the candidate to share via email and parameters for email sharing, such as recipient email and message.  
  **Returns:** The API response confirming the candidate has been shared via email.

- **share_link($id, array $data):** Generates a public link to share the candidate’s profile.  
  **Parameters:** The unique ID of the candidate to share by link and additional parameters for generating the shareable link.  
  **Returns:** The API response containing the shareable link.

- **send_questionnaire($id, array $data):** Sends a questionnaire to a candidate by ID with specified questions or content.  
  **Parameters:** The unique ID of the candidate to send the questionnaire to and the questionnaire content or parameters.  
  **Returns:** The API response confirming the questionnaire has been sent.

- **decline($id, array $data):** Declines a candidate by ID, providing a reason or status update.  
  **Parameters:** The unique ID of the candidate to decline and the parameters for declining the candidate, such as reason.  
  **Returns:** The API response confirming the candidate has been declined.

- **status_stages($id):** Retrieves a list of available status stages for a specific candidate.  
  **Parameters:** The unique ID of the candidate.  
  **Returns:** The API response containing available status stages for the candidate.

- **set_status_stage($id, array $data):** Sets the status stage of a candidate by ID to a specified stage.  
  **Parameters:** The unique ID of the candidate and the new status stage details.  
  **Returns:** The API response confirming the status stage has been updated.

- **add_tag($id, array $data):** Adds a tag to a candidate by ID to categorize or label them.  
  **Parameters:** The unique ID of the candidate and the tag details to add to the candidate.  
  **Returns:** The API response confirming the tag has been added.

- **delete($id):** Deletes a candidate by ID, removing them from the system.  
  **Parameters:** The unique ID of the candidate to delete.  
  **Returns:** The API response confirming the candidate has been deleted.
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

### Templates
Manage various templates used in job postings, emails, and other communications.

### Culture Profiles
Access and manage culture profiles to help candidates understand your organization's culture.

### Questionnaires
Create and manage questionnaires for candidates to gather more detailed information.

### Candidate Tags
Utilize tags to organize and categorize candidates for easier management.

### Helpers
Access helper functions that assist with various functionalities across the SDK.

## Reporting Issues

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