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

### **Jobs** 
The Jobs endpoint allows you to manage job postings within the VIVAHR API. You can create, retrieve, update, close, and delete job postings. Below are the available methods:

<details>
<summary>Create Job Posting API Call</summary>

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
</details>

<details>
<summary>Update Job Posting API Call</summary>

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

</details>

<details>
<summary>Retrieve Job Details API Call</summary>

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
</details>

<details>
<summary>Retrieve Job Listings API Call</summary>

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
</details>

<details>
<summary>Create Draft Job Posting API Call</summary>

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
</details>

<details>
<summary>Refresh a Job API Call</summary>

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
</details>

<details>
<summary>Close a Job API Call</summary>

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
</details>

<details>
<summary>Pause a Job API Call</summary>

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
</details>

<details>
<summary>Unpause a Job API Call</summary>

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
</details>

<details>
<summary>Share a Job API Call</summary>

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
</details>

<details>
<summary>Delete a Job API Call</summary>

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
</details>

### **Job Helpers**
Utilize helper methods to assist in job-related functionalities.

<details>
<summary>Get Position Type Helper API Call</summary>

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
</details>

<details>
<summary>Get Skill Level Helper API Call</summary>

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
</details>

<details>
<summary>Get Visibility Helper API Call</summary>

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
</details>

<details>
<summary>Get Company Industry Helper API Call</summary>

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
</details>

<details>
<summary>Get Job Functions Helper API Call</summary>

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
</details>

<details>
<summary>Get Remote Job Options API Call</summary>

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
</details>

<details>
<summary>Get Salary Type Options API Call</summary>

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

</details>


### **Candidates**
Handle candidate information such as creating new candidates, updating existing records, and retrieving candidate details.

<details>
<summary>Create Candidate API Call</summary>

## **Purpose**
This API call allows you to **create a new candidate** in the VIVAHR system. The candidate is associated with a specific position, and additional metadata such as action and source can be provided.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/candidates`
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Specifies the format of the request body. |

---

## **Request Body**
| **Field**            | **Type**   | **Description**                                   |
|----------------------|-----------|---------------------------------------------------|
| `action`             | `string`  | Specifies the action type (e.g., `"manual"`).     |
| `first_name`         | `string`  | Candidate's first name.                          |
| `last_name`          | `string`  | Candidate's last name.                           |
| `phone_number`       | `string`  | Candidate's phone number.                        |
| `email`              | `string`  | Candidate's email address.                       |
| `position_id`        | `string`  | The ID of the job position associated with the candidate. |
| `source`             | `string`  | Source of the candidate's application.           |
| `social[Facebook]`   | `string`  | Candidate's Facebook profile link (optional).    |
| `social[LinkedIn]`   | `string`  | Candidate's LinkedIn profile link (optional).    |
| `social[Pinterest]`  | `string`  | Candidate's Pinterest profile link (optional).   |
| `social[X]`          | `string`  | Candidate's X (formerly Twitter) profile link (optional). |
| `social[Website]`    | `string`  | Candidate's website link (optional).             |
| `social[Other]`      | `string`  | Any other social profile link (optional).        |

---

## **Description**
- This API call creates a new candidate in the VIVAHR system with the provided details and associates them with a specific job position.
- The `position_id` is mandatory and must correspond to the job position for which the candidate is being considered.
- Optional fields like social links can be omitted if not applicable.

**Note:**
- Ensure that all required fields are provided in the request body for successful candidate creation.

</details>

<details>
<summary>Create Candidate with Resume API Call</summary>

## **Purpose**
This API call allows you to **create a new candidate** in the VIVAHR system by uploading their resume. The candidate is associated with a specific position, and additional metadata such as action and source can be provided.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/candidates`
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
The request body should be sent as `multipart/form-data` with the following fields:

| **Field**       | **Type**   | **Description**                                   |
|-----------------|-----------|---------------------------------------------------|
| `action`        | `string`  | Specifies the action type (e.g., `"manual"`).     |
| `source`        | `string`  | Source of the candidate's application.           |
| `resume`        | `file`    | The candidate's resume file (e.g., `.pdf`, `.docx`, `.txt`). |
| `position_id`   | `string`  | The ID of the job position associated with the candidate. |

**Note:**
- Use the `FormData` object to construct the request body and append the resume file.
- Ensure the `resume` field contains a valid file from the user's input.

---

## **Description**
- This API call allows you to upload a candidate's resume and associate the candidate with a specific job position in the VIVAHR system.
- The `position_id` is mandatory and must correspond to the job position for which the candidate is being considered.
- Additional metadata such as `action` and `source` can provide context about how the candidate is being added.

**Important Notes:**
- Ensure the file input in your application correctly references the resume file.
- Supported file formats for resumes include `.pdf`, `.docx`, and `.txt`.

</details>

<details>
<summary>Update Candidate API Call</summary>

## **Purpose**
This API call allows you to **update an existing candidate's information** in the VIVAHR system. It lets you modify the candidate's personal details, job position, and associated metadata.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/candidates/:candidate_id`
  - Replace `:candidate_id` with the actual candidate ID.
- **Method:** `PUT`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must be sent as `application/x-www-form-urlencoded` with the following fields:

| **Field**         | **Type**   | **Description**                                     |
|-------------------|-----------|-----------------------------------------------------|
| `name`            | `string`  | The candidate's full name.                         |
| `phone`           | `string`  | The candidate's phone number.                      |
| `email`           | `string`  | The candidate's email address.                     |
| `position_id`     | `string`  | The ID of the job position associated with the candidate. |
| `source`          | `string`  | The source of the candidate's application.         |
| `social[Facebook]`| `string`  | URL to the candidate's Facebook profile (optional).|
| `social[LinkedIn]`| `string`  | URL to the candidate's LinkedIn profile (optional).|
| `social[Pinterest]`| `string` | URL to the candidate's Pinterest profile (optional).|
| `social[X]`       | `string`  | URL to the candidate's X (formerly Twitter) profile (optional).|
| `social[Website]` | `string`  | URL to the candidate's personal website (optional).|
| `social[Other]`   | `string`  | URL to any other relevant social media profile.    |

**Note:**
- Fields that are not provided will remain unchanged for the candidate.

---

## **Description**
- This API call allows updating specific details about an existing candidate in the VIVAHR system, such as their name, contact information, and job position.
- It also supports updating associated social media links for a more complete candidate profile.

**Important Notes:**
- Ensure that the `candidate_id` in the URL corresponds to the candidate you intend to update.
- Provide only the fields you wish to modify; others can be left blank or excluded.
- Validate all input data to ensure accuracy and compliance with the system's requirements.

</details>

<details>
<summary>Get Candidate Details API Call</summary>

## **Purpose**
This API call allows you to **retrieve the details of a specific candidate** from the VIVAHR system using their unique candidate ID.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/candidates/:candidate_id`
  - Replace `:candidate_id` with the actual candidate ID.
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This request does not require a body.

---

## **Description**
- This API call retrieves the full details of a candidate based on their unique ID.
- The response includes information such as the candidate's name, contact details, job position, application source, and any associated social media links.

**Important Notes:**
- Ensure the `candidate_id` in the URL corresponds to the candidate whose details you wish to fetch.
- The request requires a valid access token for authentication.

</details>

<details>
<summary>Get Candidate List API Call</summary>

## **Purpose**
This API call allows you to **retrieve a list of candidates** from the VIVAHR system. The results can be filtered and paginated using various optional parameters.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/candidates`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/json`              | Indicates the request body format.          |

---

## **Request Body**
- The request body is optional and can include the following parameters in JSON format:
  - **`limit`**: The maximum number of candidates to return.
  - **`offset`**: The number of candidates to skip before starting to return results.
  - **`job_id`**: Filter candidates by a specific job ID.
  - **`name_token`**: Search for candidates using a partial name match.

**Example Request Body:**
```json
{
  "limit": "10",
  "offset": "0",
  "job_id": "32761",
  "name_token": "John"
}
```
</details>

<details>
<summary>Share Candidate Internally with Team API Call</summary>

## **Purpose**
This API call allows you to **share a candidate's information** with team members within the VIVAHR platform, facilitating collaboration during the evaluation process.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/candidates/:candidate_id/share/internal`
  - Replace `:candidate_id` with the actual candidate ID.
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must be sent as `application/x-www-form-urlencoded` with the following field:

| **Field**         | **Type**   | **Description**                                     |
|-------------------|-----------|-----------------------------------------------------|
| `members[]`       | `string`  | The team member's ID(s) who will receive the shared candidate information. Multiple member IDs can be provided in an array. |

**Note:**
- Ensure the `members[]` field contains valid team member IDs from the VIVAHR system.
- The `candidate_id` in the URL must correspond to the candidate whose information is being shared.

---

## **Description**
- This API call facilitates sharing a candidate's details with internal team members, allowing them to review and evaluate the candidate.
- The shared information includes all publicly available details about the candidate, but does not include any sensitive or private data.
  
**Important Notes:**
- Replace `:candidate_id` with the candidate's unique ID in the URL.
- Provide valid team member IDs in the `members[]` field for the sharing action to be successful.
- Ensure the `Authorization` header contains a valid access token for authentication.

</details>

<details>
<summary>Share Candidate via Email API Call</summary>

## **Purpose**
This API call allows you to **share a candidate's profile via email** by sending their information along with a custom message to the specified recipients.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/candidates/:candidate_id/share/email`
  - Replace `:candidate_id` with the actual candidate ID.
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must be sent as `application/x-www-form-urlencoded` with the following fields:

| **Field**   | **Type**   | **Description**                                  |
|-------------|-----------|--------------------------------------------------|
| `name`      | `string`  | The name of the person sharing the candidate's profile. |
| `email`     | `string`  | The email address of the recipient.              |
| `message`   | `string`  | The custom message that will be included in the email. |

**Note:**
- Ensure the recipient's email address is valid and properly formatted.

---

## **Description**
- This API allows you to share a candidate's profile via email with a personalized message.
- The `candidate_id` should be replaced with the actual ID of the candidate whose profile is being shared.

**Important Notes:**
- Make sure the `candidate_id` is correctly replaced with the candidate’s ID.
- Validate the recipient's email and message content for accuracy before sending.
- This API is useful for sharing candidate details directly with team members or external contacts.

</details>

<details>
<summary>Share Candidate via Link API Call</summary>

## **Purpose**
This API call allows you to **share a candidate's profile via a link**, making it easy to send the candidate's profile to others directly.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/candidates/:candidate_id/share/link`
  - Replace `:candidate_id` with the actual candidate ID.
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This API call does not require a request body.

**Note:**
- The API will generate a link to share the candidate's profile. No additional data is required in the request body.

---

## **Description**
- This API call generates a shareable link to a candidate's profile, allowing you to share the candidate's details quickly and easily.
- The `candidate_id` in the URL must be replaced with the actual candidate's ID whose profile you want to share.

**Important Notes:**
- Ensure the `candidate_id` is correctly replaced with the candidate’s ID.
- This API is particularly useful when you need to send a quick link to the candidate's profile without manually sharing any details.

</details>

<details>
<summary>Send Candidate Questionnaire API Call</summary>

## **Purpose**
This API call allows you to **send a questionnaire** to a candidate, allowing them to fill it out and submit their responses. It includes options for a subject, body, and selecting specific questionnaire templates.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/candidates/:candidate_id/send-questionnaire`
  - Replace `:candidate_id` with the actual candidate ID.
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must be sent as `application/x-www-form-urlencoded` with the following fields:

| **Field**          | **Type**   | **Description**                                           |
|--------------------|-----------|-----------------------------------------------------------|
| `subject`          | `string`  | The subject of the questionnaire email.                   |
| `body`             | `string`  | The body of the email to be sent with the questionnaire.   |
| `questionnaire_id` | `string`  | The ID of the questionnaire to send to the candidate.      |
| `template_id`      | `string`  | The ID of the template to be used for the questionnaire.   |

**Note:**
- Ensure that the `questionnaire_id` and `template_id` correspond to valid entries in the system.
- The `subject` and `body` can be customized to tailor the message sent to the candidate.

---

## **Description**
- This API sends a questionnaire to the specified candidate via email.
- The email includes a subject, body, and a link to the questionnaire, allowing the candidate to fill it out.
  
**Important Notes:**
- Make sure to replace the `candidate_id` with the actual ID of the candidate you want to send the questionnaire to.
- Both `questionnaire_id` and `template_id` must be valid to ensure that the correct questionnaire and template are sent.
- The `Authorization` header must contain a valid access token.

</details>

<details>
<summary>Decline Candidate API Call</summary>

## **Purpose**
This API call allows you to **decline a candidate** by updating their disposition status in the VIVAHR system. This is typically used when a candidate is not moving forward in the hiring process.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/candidates/:candidate_id/decline`
  - Replace `:candidate_id` with the actual candidate ID.
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must be sent as `application/x-www-form-urlencoded` with the following fields:

| **Field**         | **Type**   | **Description**                                     |
|-------------------|-----------|-----------------------------------------------------|
| `disposition`     | `string`  | The disposition reason for declining the candidate (e.g., "rejected", "not suitable"). |

**Note:**
- The `disposition` field is required to specify why the candidate is being declined.

---

## **Description**
- This API call updates the candidate’s status to "declined" and sets the disposition reason in the system.
- You must provide the `disposition` reason when calling this API, which explains why the candidate is not being moved forward.

**Important Notes:**
- Make sure to replace the `candidate_id` in the URL with the actual ID of the candidate being declined.
- Ensure the `disposition` value is appropriate for the context (e.g., "rejected", "not suitable").

</details>

<details>
<summary>List Candidate Status Stages API Call</summary>

## **Purpose**
This API call allows you to **retrieve the status stages** for a specific candidate in the VIVAHR system. This helps track the different stages a candidate goes through in the hiring process.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/candidates/:candidate_id/status-stages`
  - Replace `:candidate_id` with the actual candidate ID.
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This API call does not require a request body.

---

## **Description**
- This API call retrieves the available status stages for a candidate.
- The status stages are the various points or phases in the hiring process that the candidate progresses through.

**Important Notes:**
- Ensure that the `candidate_id` is correctly provided in the URL to fetch the correct status stages for that candidate.
- You do not need to provide any request body for this call.

</details>

<details>
<summary>Set Candidate Status API Call</summary>

## **Purpose**
This API call allows you to **set or update the status** of a specific candidate in the VIVAHR system. It allows you to assign the candidate a new status based on predefined status options.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/candidates/:candidate_id/set-status`
  - Replace `:candidate_id` with the actual candidate ID.
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must be sent as `application/x-www-form-urlencoded` with the following fields:

| **Field**        | **Type**   | **Description**                            |
|------------------|-----------|--------------------------------------------|
| `status_id`      | `string`  | The ID of the status to be assigned to the candidate. |

**Note:**
- Ensure that the `status_id` corresponds to a valid status in the system.

---

## **Description**
- This API call assigns a new status to the candidate, updating their progress in the hiring process.
- The `status_id` provided should match an existing status in the VIVAHR system.

**Important Notes:**
- Ensure that the `candidate_id` and `status_id` are correctly provided in the request.
- Only valid status IDs will be accepted by the system.

</details>

<details>
<summary>Assign Tag to Candidate API Call</summary>

## **Purpose**
This API call allows you to **assign a tag** to a specific candidate in the VIVAHR system. Tags help categorize candidates based on different criteria or characteristics for easier management and searching.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/candidates/:candidate_id/tag`
  - Replace `:candidate_id` with the actual candidate ID.
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must be sent as `application/x-www-form-urlencoded` with the following fields:

| **Field**       | **Type**   | **Description**                            |
|-----------------|-----------|--------------------------------------------|
| `tag`           | `string`  | The tag to be assigned to the candidate.   |

**Note:**
- Ensure that the `tag` is a valid string and matches your tagging conventions.

---

## **Description**
- This API call is used to assign a tag to a candidate, helping to categorize and filter candidates within the system.
- The tag can represent different attributes of the candidate, such as skills, source, or stage in the hiring process.

**Important Notes:**
- Ensure the `candidate_id` in the URL is correct.
- Tags should be meaningful and standardized for better candidate tracking.

</details>

<details>
<summary>Delete Candidate API Call</summary>

## **Purpose**
This API call allows you to **delete a specific candidate** from the VIVAHR system. Once deleted, the candidate's information will be permanently removed.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/candidates/:candidate_id`
  - Replace `:candidate_id` with the actual candidate ID.
- **Method:** `DELETE`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This API call does not require a request body.

**Note:**
- No additional data needs to be provided in the request body.

---

## **Description**
- This API call deletes a candidate's profile from the VIVAHR system.
- Once a candidate is deleted, their information is permanently removed and cannot be recovered.

**Important Notes:**
- Ensure that the `candidate_id` in the URL corresponds to the correct candidate you want to delete.
- This action is irreversible, so double-check before sending the request.

</details>

### **Candidate Notes**
Manage notes related to candidates, allowing for tracking of interactions and observations.

<details>
<summary>Add Candidate Note API Call</summary>

## **Purpose**
This API call allows you to **add a note** to a specific candidate's profile in the VIVAHR system. The note can include any additional information or comments related to the candidate.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/candidate-notes`
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must be sent as `application/x-www-form-urlencoded` with the following fields:

| **Field**         | **Type**   | **Description**                                     |
|-------------------|-----------|-----------------------------------------------------|
| `candidate_id`    | `string`  | The ID of the candidate to whom the note will be added. |
| `note`            | `string`  | The content of the note to be added to the candidate's profile. |

**Note:**
- Ensure that both the `candidate_id` and the `note` are provided in the request.

---

## **Description**
- This API call allows adding notes to a candidate's profile, which can be used for tracking or adding additional details about the candidate.
- You can add any relevant information, such as interview feedback, comments, or observations.

**Important Notes:**
- The `candidate_id` should correspond to a valid candidate in the system.
- The note field should not be left empty and should contain relevant information about the candidate.

</details>

<details>
<summary>Get Candidate Note API Call</summary>

## **Purpose**
This API call allows you to **retrieve a specific candidate's note** by using the candidate note ID. It returns the details of the note associated with a candidate in the VIVAHR system.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/candidate-notes/:candidate_note_id`
  - Replace `:candidate_note_id` with the actual candidate note ID.
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This request does not require a body.

---

## **Description**
- This API call retrieves the details of a specific candidate's note using the note ID.
- The response includes information about the note, such as its content and the candidate it is associated with.

**Important Notes:**
- Ensure that the `candidate_note_id` in the URL corresponds to an existing note in the system.
- Only valid access tokens can be used to access this endpoint.

</details>

<details>
<summary>List Candidate Notes API Call</summary>

## **Purpose**
This API call allows you to **retrieve a list of candidate notes**. You can filter the notes by candidate ID and paginate through them by specifying the limit and offset.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/candidate-notes`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/json`              | Indicates the content type of the request body. |

---

## **Request Body**
The request body must be sent as `application/json` with the following fields:

| **Field**         | **Type**   | **Description**                                    |
|-------------------|-----------|----------------------------------------------------|
| `limit`           | `string`  | The maximum number of notes to retrieve.           |
| `offset`          | `string`  | The starting point for pagination (use to skip records). |
| `candidate_id`    | `string`  | The ID of the candidate whose notes you want to retrieve. |

**Note:**
- You can adjust the `limit` and `offset` to control the number of notes returned and to paginate through the results.

---

## **Description**
- This API call retrieves a paginated list of notes associated with a specific candidate in the VIVAHR system.
- The list can be filtered by `candidate_id` and can include additional pagination parameters (`limit` and `offset`).

**Important Notes:**
- Ensure the `candidate_id` is valid and corresponds to an existing candidate in the system.
- The `limit` parameter determines how many notes to retrieve per request, and the `offset` allows you to skip records for pagination.

</details>

<details>
<summary>Delete Candidate Note API Call</summary>

## **Purpose**
This API call allows you to **delete a specific candidate note** by its ID.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/candidate-notes/:candidate_note_id`
  - Replace `:candidate_note_id` with the actual ID of the candidate note you want to delete.
- **Method:** `DELETE`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This API call does **not** require a request body.

---

## **Description**
- This API call deletes a candidate note identified by its `candidate_note_id`.
- It is useful for removing notes that are no longer relevant or need to be cleared from the system.

**Important Notes:**
- Ensure that the `candidate_note_id` in the URL corresponds to an existing note.
- Once deleted, the note cannot be recovered, so proceed with caution.

</details>

### **Compliance**
Access compliance-related functionalities to ensure that your hiring practices adhere to relevant regulations.

<details>
<summary>Get Compliance API Call</summary>

## **Purpose**
This API call retrieves **compliance information** from the VIVAHR system. It provides details on the compliance status and other related information.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/compliance`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This API call does not require a request body.

---

## **Description**
- This API call fetches the compliance data for the VIVAHR system.
- It returns details about the system’s compliance status, including any necessary actions or updates.

**Important Notes:**
- Ensure you provide a valid access token in the `Authorization` header.
- No request body is required for this GET request.

</details>

<details>
<summary>Update EEO Survey Compliance API Call</summary>

## **Purpose**
This API call allows you to **update EEO (Equal Employment Opportunity) survey compliance** data in the VIVAHR system. It lets you modify or add the EEO survey information and associated dispositions.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/compliance/eeo-survey`
- **Method:** `PATCH`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must be sent as `application/x-www-form-urlencoded` with the following fields:

| **Field**          | **Type**   | **Description**                                  |
|--------------------|-----------|--------------------------------------------------|
| `eeo_survey`       | `string`  | The data related to the EEO survey.              |
| `eeo_dispositions` | `string`  | The dispositions related to the EEO survey data. |

**Note:**
- Both fields should contain valid information as required by the system.

---

## **Description**
- This API call updates the EEO survey data and its associated dispositions in the VIVAHR system.
- The data is essential for maintaining compliance with EEO regulations.

**Important Notes:**
- Ensure that the request body contains valid survey and disposition data.
- Only provide the fields that need to be updated. Other data will remain unchanged.
- Ensure the `Authorization` header contains a valid access token for authentication.

</details>

#### **Disposition Reasons**

<details>
<summary>Create Disposition Reason API Call</summary>

## **Purpose**
This API call allows you to **create a new disposition reason** for a candidate in the VIVAHR system. Disposition reasons are used to categorize the outcome of a candidate's status or hiring process.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/disposition-reasons`
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must be sent as `application/x-www-form-urlencoded` with the following fields:

| **Field**         | **Type**   | **Description**                                     |
|-------------------|-----------|-----------------------------------------------------|
| `disposition`     | `string`  | The name or description of the disposition reason. |

**Note:**
- The `disposition` field is required to provide the reason for the disposition.

---

## **Description**
- This API call creates a new disposition reason, which can then be used when setting the status of candidates in the VIVAHR system.
- Disposition reasons help categorize and track the progress of candidates through the hiring pipeline.

**Important Notes:**
- Ensure that the `disposition` value is valid and descriptive of the outcome.
- This API call is essential for improving candidate tracking and workflow management.

</details>

<details>
<summary>Update Disposition Reason API Call</summary>

## **Purpose**
This API call allows you to **update an existing disposition reason** in the VIVAHR system. Disposition reasons are used to categorize the outcome of a candidate's status or hiring process, and this call allows modification of the name or description of an existing reason.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/disposition-reasons/:id`
  - Replace `:id` with the actual ID of the disposition reason you want to update.
- **Method:** `PUT`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must be sent as `application/x-www-form-urlencoded` with the following fields:

| **Field**         | **Type**   | **Description**                                     |
|-------------------|-----------|-----------------------------------------------------|
| `disposition`     | `string`  | The new name or description for the disposition reason. |

**Note:**
- The `disposition` field is required to specify the new description or name for the disposition reason.

---

## **Description**
- This API call updates the name or description of an existing disposition reason in the VIVAHR system.
- You must specify the `id` of the disposition reason you want to modify in the URL.

**Important Notes:**
- Ensure that the `disposition` value is descriptive and correctly reflects the intended outcome.
- The `id` in the URL must correspond to an existing disposition reason in the system.

</details>

<details>
<summary>Get Disposition Reason API Call</summary>

## **Purpose**
This API call allows you to **retrieve an existing disposition reason** from the VIVAHR system by its unique ID. It provides the details associated with the specified disposition reason.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/disposition-reasons/:id`
  - Replace `:id` with the actual ID of the disposition reason you want to retrieve.
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This API call does not require a request body.

---

## **Description**
- This API call retrieves the details of a disposition reason in the VIVAHR system using its unique ID.
- The returned data will include the name and description of the disposition reason.

**Important Notes:**
- Ensure the `id` in the URL corresponds to an existing disposition reason in the system.
- No request body is required for this GET request.

</details>

<details>
<summary>Get All Disposition Reasons API Call</summary>

## **Purpose**
This API call allows you to **retrieve all the disposition reasons** available in the VIVAHR system. It returns a list of all the disposition reasons defined in the system.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/disposition-reasons`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This API call does not require a request body.

---

## **Description**
- This API call retrieves a list of all disposition reasons defined in the VIVAHR system.
- It provides information such as the name and description for each disposition reason.

**Important Notes:**
- Ensure that you have a valid access token in the `Authorization` header.
- No request body is required for this GET request.

</details>

<details>
<summary>Delete Disposition Reason API Call</summary>

## **Purpose**
This API call allows you to **delete an existing disposition reason** from the VIVAHR system. It requires the `id` of the disposition reason you wish to delete.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/disposition-reasons/:id`
  - Replace `:id` with the actual disposition reason ID to be deleted.
- **Method:** `DELETE`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This API call does not require a request body.

---

## **Description**
- This API call deletes a specific disposition reason from the system based on the provided `id`.
- Once deleted, the disposition reason will no longer be available for use.

**Important Notes:**
- Ensure the `id` in the URL is the valid ID of the disposition reason you want to delete.
- Ensure that you have the appropriate permissions to delete disposition reasons.
- No request body is required for this DELETE request.

</details>

### Departments
Interact with departments within your organization for job postings and candidate tracking.

<details>
<summary>Create Department API Call</summary>

## **Purpose**
This API call allows you to **create a new department** in the VIVAHR system. It enables the addition of a department along with the associated team members.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/departments`
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must be sent as `application/x-www-form-urlencoded` with the following fields:

| **Field**         | **Type**   | **Description**                                     |
|-------------------|-----------|-----------------------------------------------------|
| `name`            | `string`  | The name of the department.                         |
| `team_members[]`  | `array`   | A list of team member IDs to associate with the department. |

**Note:**
- Provide the department's name and the team members to be included.

---

## **Description**
- This API call creates a new department in the system and assigns specified team members to it.
- The `team_members[]` field accepts multiple team member IDs to be added to the department.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.
- Validate that the team member IDs are correct and exist in the system.
- The department name must be unique.

</details>

<details>
<summary>Update Department API Call</summary>

## **Purpose**
This API call allows you to **update a department** by modifying its name and associated team members.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/departments/:department_id`
- **Method:** `PUT`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must be sent as `application/x-www-form-urlencoded` with the following fields:

| **Field**        | **Type**  | **Description**                                     |
|------------------|----------|-----------------------------------------------------|
| `name`           | `string` | The name of the department.                         |
| `team_member[]`  | `array`  | A list of team member IDs to be added to the department. |

**Note:**
- The `department_id` must be specified in the URL to target the department to be updated.
- If no team members are to be updated, the `team_member[]` field can be omitted.

---

## **Description**
- This API call updates the details of a specified department.
- You can modify the department's name and the team members associated with it.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.
- The department ID must be valid and exist in the system.

</details>

<details>
<summary>Get Department API Call</summary>

## **Purpose**
This API call allows you to **retrieve details of a specific department** by its ID.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/departments/:department_id`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Description**
- This API call retrieves the details of a department by its unique ID.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.
- The department ID must be valid.

</details>

<details>
<summary>Get All Departments API Call</summary>

## **Purpose**
This API call allows you to **retrieve a list of departments**, with optional pagination.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/departments`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/json`               | Indicates that the body is in JSON format.  |

---

## **Request Body**
The request body must be sent as `application/json` with the following fields:

| **Field**         | **Type**  | **Description**                                    |
|-------------------|----------|----------------------------------------------------|
| `limit`           | `string` | The maximum number of departments to return.       |
| `offset`          | `string` | The offset for pagination.                         |

**Note:**
- `limit` and `offset` are optional parameters to paginate the results.

---

## **Description**
- This API call retrieves a list of departments with an optional limit and offset for pagination.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.

</details>

<details>
<summary>Delete Department API Call</summary>

## **Purpose**
This API call allows you to **delete a department** by its ID.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/departments/:department_id`
- **Method:** `DELETE`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Description**
- This API call deletes a specific department identified by its `department_id`.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.
- The department ID must be valid and exist in the system.
- Deleting a department is a permanent action.

</details>

### Locations
Manage and retrieve location information for job postings and candidate applications.

<details>
<summary>Create Location API Call</summary>

## **Purpose**
This API call allows you to **create a new location** in the system, providing details such as the location's name, address, country, city, state, and associated team members.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/locations`
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must be sent as `application/x-www-form-urlencoded` with the following fields:

| **Field**         | **Type**   | **Description**                                    |
|-------------------|-----------|----------------------------------------------------|
| `location_name`   | `string`  | The name of the location.                          |
| `street_address`  | `string`  | The street address of the location.                |
| `country`         | `string`  | The country of the location.                       |
| `city`            | `string`  | The city of the location.                          |
| `state`           | `string`  | The state of the location.                         |
| `zipcode`         | `string`  | The zip code of the location.                      |
| `team_members[]`  | `array`   | A list of team member IDs to be associated with the location. |

**Note:**
- The location’s address details must be provided.
- If no team members are to be added, the `team_members[]` field can be omitted.

---

## **Description**
- This API call creates a new location and associates it with specified team members.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.

</details>

<details>
<summary>Update Location API Call</summary>

## **Purpose**
This API call allows you to **update an existing location** by modifying its name, address, and team members.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/locations/:locationID`
- **Method:** `PUT`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must be sent as `application/x-www-form-urlencoded` with the following fields:

| **Field**         | **Type**   | **Description**                                    |
|-------------------|-----------|----------------------------------------------------|
| `location_name`   | `string`  | The name of the location.                          |
| `street_address`  | `string`  | The street address of the location.                |
| `country`         | `string`  | The country of the location.                       |
| `city`            | `string`  | The city of the location.                          |
| `state`           | `string`  | The state of the location.                         |
| `zipcode`         | `string`  | The zip code of the location.                      |
| `team_members[]`  | `array`   | A list of team member IDs to be associated with the location. |

**Note:**
- The `locationID` must be specified in the URL to target the location to be updated.
- If no team members are to be updated, the `team_members[]` field can be omitted.

---

## **Description**
- This API call updates the details of a specific location identified by its ID.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.
- The location ID must be valid and exist in the system.

</details>

<details>
<summary>Get Location API Call</summary>

## **Purpose**
This API call allows you to **retrieve details of a specific location** using its ID.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/locations/:locationID`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Description**
- This API call retrieves the details of a location identified by its unique ID.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.
- The location ID must be valid.

</details>

<details>
<summary>Get All Locations API Call</summary>

## **Purpose**
This API call allows you to **retrieve a list of locations** with optional pagination parameters.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/locations`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/json`               | Indicates that the body is in JSON format.  |

---

## **Request Body**
The request body must be sent as `application/json` with the following fields:

| **Field**         | **Type**  | **Description**                                    |
|-------------------|----------|----------------------------------------------------|
| `limit`           | `string` | The maximum number of locations to return.         |
| `offset`          | `string` | The offset for pagination.                         |

**Note:**
- `limit` and `offset` are optional parameters to paginate the results.

---

## **Description**
- This API call retrieves a list of locations with optional parameters to limit the results.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.

</details>

<details>
<summary>Delete Location API Call</summary>

## **Purpose**
This API call allows you to **delete a location** by its ID.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/locations/:locationID`
- **Method:** `DELETE`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Description**
- This API call deletes a specific location identified by its `locationID`.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.
- The location ID must be valid.
- Deleting a location is permanent and cannot be undone.

</details>

<details>
<summary>Reactivate Location API Call</summary>

## **Purpose**
This API call allows you to **reactivate a previously deleted location** by its ID.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/locations/:locationID/reactivate`
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Description**
- This API call reactivates a location that was previously deleted.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.
- The location ID must be valid and previously deleted.

</details>

### Team Members
Handle information related to team members who participate in the hiring process.

<details>
<summary>Create Team Member API Call</summary>

## **Purpose**
This API call allows you to **create a new team member** in the system, providing details such as their name, email, password, profile photo, associated locations, job openings, and additional settings.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/team-members`
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
The request body must be sent as `multipart/form-data` with the following fields:

| **Field**          | **Type**      | **Description**                                               |
|--------------------|--------------|---------------------------------------------------------------|
| `email_user`       | `boolean`    | Indicates if the team member should receive an email invite (`1` or `0`). |
| `first_name`       | `string`     | The first name of the team member.                            |
| `last_name`        | `string`     | The last name of the team member.                             |
| `profile_photo`    | `file`       | A file representing the team member's profile photo.          |
| `remove_image`     | `boolean`    | Indicates if the profile photo should be removed (`1` or `0`).|
| `member_status`    | `integer`    | The status of the team member (`1` for active).               |
| `email`            | `string`     | The team member's email address.                              |
| `password`         | `string`     | The team member's password.                                   |
| `location_ids[]`   | `array`      | An array of location IDs the team member will be associated with. |
| `job_openings[]`   | `array`      | An array of job opening IDs the team member will be associated with. |
| `profile_id`       | `string`     | The ID of the profile (optional, can be left empty).          |

**Note:**
- Use the `fileInput.files[0]` reference to upload the profile photo file.
- You can specify multiple job openings using repeated `job_openings[]` fields.

---

## **Description**
- This API call creates a new team member with the specified details.
- If `email_user` is set to `1`, the new team member will receive an email invitation.
- `remove_image` allows you to specify whether to remove an existing profile image for updates.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.
- The `profile_photo` file should be uploaded as part of the `multipart/form-data`.

</details>

<details>
<summary>Update Team Member API Call</summary>

## **Purpose**
This API call allows you to **update an existing team member's details** in the system, such as their name, email, profile photo, associated locations, and job openings.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/team-members/:employer_id`
  - Replace `:employer_id` with the ID of the employer or team member to update.
- **Method:** `PUT`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
The request body must be sent as `multipart/form-data` with the following fields:

| **Field**          | **Type**      | **Description**                                               |
|--------------------|--------------|---------------------------------------------------------------|
| `email_user`       | `boolean`    | Indicates if the team member should receive an email invite (`1` or `0`). |
| `first_name`       | `string`     | The first name of the team member.                            |
| `last_name`        | `string`     | The last name of the team member.                             |
| `profile_photo`    | `file`       | A file representing the team member's profile photo.          |
| `remove_image`     | `boolean`    | Indicates if the profile photo should be removed (`1` or `0`).|
| `member_status`    | `integer`    | The status of the team member (`1` for active).               |
| `email`            | `string`     | The team member's email address.                              |
| `password`         | `string`     | The team member's password.                                   |
| `location_ids[]`   | `array`      | An array of location IDs the team member will be associated with. |
| `job_openings[]`   | `array`      | An array of job opening IDs the team member will be associated with. |
| `profile_id`       | `string`     | The ID of the profile (optional, can be left empty).          |

**Note:**
- Use the `fileInput.files[0]` reference to upload the profile photo file.
- You can specify multiple job openings using repeated `job_openings[]` fields.

---

## **Description**
- This API call updates the details of an existing team member.
- If `email_user` is set to `1`, the team member will receive an email notification about the updates.
- `remove_image` allows you to specify whether to remove an existing profile image.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.
- The `profile_photo` file should be uploaded as part of the `multipart/form-data`.

</details>

<details>
<summary>Get Team Member by ID API Call</summary>

## **Purpose**
This API call allows you to **retrieve details of a specific team member** by their unique ID.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/team-members/:employer_id`
  - Replace `:employer_id` with the ID of the team member to retrieve.
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This request does not require a body.

---

## **Description**
- This API retrieves detailed information about a team member identified by their `employer_id`.
- Use this endpoint to fetch data such as the team member's name, email, profile details, and associated locations or job openings.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token.
- Replace `:employer_id` in the URL with the actual ID of the team member whose details you want to fetch.

</details>

<details>
<summary>List Team Members API Call</summary>

## **Purpose**
This API call allows you to **retrieve a list of all team members** within the organization.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/team-members`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This request does not require a body.

---

## **Description**
- This API returns a list of all team members, including their details such as names, emails, roles, associated locations, and job openings.
- Use this endpoint to manage or display the list of team members in your application.

**Important Notes:**
- Ensure the `Authorization` header contains a valid access token.
- This endpoint supports pagination. If additional parameters like `limit` or `offset` are required, they can be appended as query parameters to the URL (e.g., `https://auth.vivahr.com/v1/team-members?limit=10&offset=0`).

</details>

<details>
<summary>Activate Custom Roles API Call</summary>

## **Purpose**
This API is used to **activate custom roles** for team members. No additional values need to be provided in the request body.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/team-members`
- **Method:** `PATCH`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This request does **not require any specific values** in the body.

**Note:**
- No fields need to be sent in the body for this operation.

---

## **Description**
- This endpoint is specifically designed to **activate custom roles** for team members without requiring additional input.
- Ensure that your authorization token has sufficient permissions to perform this action.

**Important Notes:**
- The activation process applies to custom roles already configured within the system.
- Contact the support team if roles do not activate as expected.

</details>

### Embed Careers
Embed career opportunities into your website or platform, allowing candidates to apply directly.

<details>
<summary>Get Embedded Career Jobs API Call</summary>

## **Purpose**
This API retrieves the embedded job postings configured for a specific career page.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/embed/career-jobs`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This request does **not require a body**.

---

## **Description**
- The API is used to retrieve a list of embedded job postings associated with a company's career page.
- This call fetches job details as configured and displayed on the career page.

**Important Notes:**
- The authorization token must have sufficient access rights to retrieve career job postings.
- Ensure that the embedded configuration for the career page is properly set up within the system.

</details>

<details>
<summary>Get Embedded Jobs API Call</summary>

## **Purpose**
This API retrieves the embedded job postings available for external integrations or career page displays.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/embed/jobs`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This request does **not require a body**.

---

## **Description**
- The API fetches job postings configured for embedding via external systems or career page widgets.
- The retrieved data includes job details that are optimized for integration purposes.

**Important Notes:**
- Ensure your access token has sufficient permissions to access the embedded jobs data.
- The endpoint provides jobs intended for external systems or career page embeds.

</details>

### Pipelines
Manage the various stages of the candidate pipeline throughout the hiring process.

<details>
<summary>Create Pipeline API Call</summary>

## **Purpose**
Creates a new pipeline for organizing and managing candidates or job processes.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/pipelines`
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must include the following fields:

| **Field**        | **Type**    | **Description**                           |
|------------------|-------------|-------------------------------------------|
| `pipeline_name`  | `string`    | The name of the new pipeline.             |

**Note:**
- No additional fields are required to be added.

---

## **Description**
- This API creates a new pipeline to organize the hiring or job processes.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token.
</details>

<details>
<summary>Update Pipeline API Call</summary>

## **Purpose**
Updates an existing pipeline with a new name.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/pipelines/{pipeline_id}`
- **Method:** `PUT`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must include the following fields:

| **Field**        | **Type**    | **Description**                           |
|------------------|-------------|-------------------------------------------|
| `pipeline_name`  | `string`    | The updated name of the pipeline.         |

**Note:**
- No additional fields are required to be added.

---

## **Description**
- This API updates an existing pipeline with the specified pipeline ID.

**Important Notes:**
- Replace `{pipeline_id}` in the URL with the actual pipeline ID to update.
</details>

<details>
<summary>Get Pipeline API Call</summary>

## **Purpose**
Retrieves information about a specific pipeline.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/pipelines/{pipeline_id}`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This API does not require a request body.

---

## **Description**
- This API retrieves details of a pipeline using the pipeline ID.

**Important Notes:**
- Replace `{pipeline_id}` in the URL with the actual pipeline ID to retrieve.
</details>

<details>
<summary>Get Pipelines API Call</summary>

## **Purpose**
Retrieves a list of pipelines with optional pagination.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/pipelines`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/json`               | Indicates the content type of the request body. |

---

## **Request Body**
The request body must include the following fields:

| **Field**        | **Type**    | **Description**                           |
|------------------|-------------|-------------------------------------------|
| `limit`          | `integer`   | The number of pipelines to retrieve.      |
| `offset`         | `integer`   | The starting point for pagination.        |

**Note:**
- Both `limit` and `offset` are optional for pagination. 

---

## **Description**
- This API retrieves a list of pipelines with pagination support.

**Important Notes:**
- Provide `limit` and `offset` values to control the number of pipelines returned.
</details>

<details>
<summary>Delete Pipeline API Call</summary>

## **Purpose**
Deletes a specific pipeline.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/pipelines/{pipeline_id}`
- **Method:** `DELETE`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This API does not require a request body.

---

## **Description**
- This API deletes a specific pipeline using its pipeline ID.

**Important Notes:**
- Replace `{pipeline_id}` in the URL with the actual pipeline ID to delete.
</details>

### Pipeline Stages

<details>
<summary>Create Pipeline Stage API Call</summary>

## **Purpose**
Creates a new pipeline stage within a specified pipeline.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/pipeline-stages`
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must include the following fields:

| **Field**        | **Type**    | **Description**                               |
|------------------|-------------|-----------------------------------------------|
| `pipeline_id`    | `integer`   | The ID of the pipeline where the stage will be added. |
| `stage_type_id`  | `integer`   | The ID for the type of stage (e.g., initial stage, interview stage). |
| `name`           | `string`    | The name of the stage.                        |
| `sort`           | `integer`   | The sort order for the stage.                 |

**Note:**
- All fields are required to properly define the new pipeline stage.

---

## **Description**
- This API creates a new stage for the specified pipeline with the given stage type.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token.
- Replace the fields `pipeline_id` and `stage_type_id` with valid IDs from your system.
</details>

<details>
<summary>Update Pipeline Stage API Call</summary>

## **Purpose**
Updates an existing pipeline stage within a specified pipeline.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/pipeline-stages/:stage_id`
  - Replace `:stage_id` with the ID of the pipeline stage to update.
- **Method:** `PUT`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must include the following fields:

| **Field**        | **Type**    | **Description**                               |
|------------------|-------------|-----------------------------------------------|
| `pipeline_id`    | `integer`   | The ID of the pipeline where the stage exists. |
| `stage_type_id`  | `integer`   | The ID for the type of stage (e.g., interview, disqualified). |
| `name`           | `string`    | The name of the stage.                        |
| `sort`           | `integer`   | The sort order for the stage.                 |

**Note:**
- Replace `:stage_id` with the specific ID of the pipeline stage you want to update.
- All fields are required to update the pipeline stage.

---

## **Description**
- This API updates the details of an existing pipeline stage. You must specify the pipeline stage ID and provide the new details for the stage.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token.
- Replace the `pipeline_id` and `stage_type_id` with valid IDs from your system.
</details>

<details>
<summary>Get Pipeline Stage API Call</summary>

## **Purpose**
Fetches the details of a specific pipeline stage by its ID.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/pipeline-stages/:stage_id`
  - Replace `:stage_id` with the ID of the pipeline stage you wish to retrieve.
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This API call does not require a request body.

---

## **Description**
- This API retrieves the details of a specific pipeline stage, identified by its `stage_id`. The response will contain the information for the stage, such as the pipeline it belongs to, its type, name, and sort order.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token.
- Replace `:stage_id` with the specific ID of the pipeline stage you want to fetch.
</details>

<details>
<summary>Delete Pipeline Stage API Call</summary>

## **Purpose**
Deletes a specific pipeline stage identified by its `stage_id`.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/pipeline-stages/:stage_id`
  - Replace `:stage_id` with the ID of the pipeline stage you wish to delete.
- **Method:** `DELETE`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This API call does not require a request body.

---

## **Description**
- This API deletes a pipeline stage identified by its `stage_id`. After a successful deletion, the stage will no longer be part of the pipeline.
- The response will indicate the success or failure of the deletion request.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token.
- Replace `:stage_id` with the specific ID of the pipeline stage you want to delete.
</details>

<details>
<summary>List Pipeline Stage Types API Call</summary>

## **Purpose**
Retrieves a list of all available pipeline stage types.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/pipeline-stages/types`
  - No dynamic variables in the URL.
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This API call does not require a request body.

---

## **Description**
- This API retrieves a list of all available pipeline stage types. It is useful for understanding the different stage types that can be used in pipeline stages.
- A successful response will include the details of the available pipeline stage types.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token.
</details>

### Scorecards
Utilize scorecards for evaluating candidates during the interview and hiring process.

<details>
<summary>Create Scorecard API Call</summary>

## **Purpose**
Creates a new scorecard with sections and fields.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/scorecards`
  - No dynamic variables in the URL.
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must be sent as `application/x-www-form-urlencoded` with the following fields:

| **Field**                 | **Type**  | **Description**                            |
|---------------------------|-----------|--------------------------------------------|
| `scorecard_name`           | `string`  | The name of the scorecard.                 |
| `section[0][name]`         | `string`  | The name of the first section.            |
| `section[0][fields][]`     | `array`   | The list of fields for the first section.  |

**Note:**
- The number of sections and fields may vary. In this case, only the first section is shown as an example.
- Ensure the request body is properly encoded in `application/x-www-form-urlencoded`.

---

## **Description**
- This API call is used to create a new scorecard that can be used for evaluating candidates. 
- You can include multiple sections, and each section can contain various fields.
- The response will include the details of the newly created scorecard.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token.
</details>

<details>
<summary>Update Scorecard API Call</summary>

## **Purpose**
Updates an existing scorecard with new sections and fields.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/scorecards/:scorecard_id`
  - Replace `:scorecard_id` with the ID of the scorecard to be updated.
- **Method:** `PUT`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must be sent as `application/x-www-form-urlencoded` with the following fields:

| **Field**                 | **Type**  | **Description**                            |
|---------------------------|-----------|--------------------------------------------|
| `scorecard_name`           | `string`  | The name of the scorecard.                 |
| `section[0][name]`         | `string`  | The name of the first section.            |
| `section[0][fields][]`     | `array`   | The list of fields for the first section.  |

**Note:**
- The number of sections and fields may vary. In this case, only the first section is shown as an example.
- Ensure the request body is properly encoded in `application/x-www-form-urlencoded`.
- Replace `:scorecard_id` with the actual ID of the scorecard you want to update.

---

## **Description**
- This API call is used to update an existing scorecard, including its name, sections, and fields. 
- You can modify the sections and fields of the scorecard to reflect the most recent changes.
- The response will include the updated scorecard details.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token.
</details>

<details>
<summary>Retrieve Scorecard API Call</summary>

## **Purpose**
Retrieves an existing scorecard by its ID.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/scorecards/:scorecard_id`
  - Replace `:scorecard_id` with the ID of the scorecard you want to retrieve.
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
No request body is required for this API call.

---

## **Description**
- This API call retrieves the details of an existing scorecard, including its sections and fields, based on the provided `scorecard_id`.
- The response will contain the scorecard's details, including the name, sections, and the fields within each section.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token for authentication.
- Replace `:scorecard_id` with the actual ID of the scorecard you want to retrieve.
</details>

<details>
<summary>List Scorecards API Call</summary>

## **Purpose**
Retrieves a list of all scorecards.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/scorecards`
  - This endpoint lists all available scorecards.
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
No request body is required for this API call.

---

## **Description**
- This API call retrieves all scorecards available within the system, including their sections and fields.
- The response will contain a list of scorecards with relevant details such as their names, sections, and field data.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token for authentication.
</details>

<details>
<summary>Delete Scorecard API Call</summary>

## **Purpose**
Deletes a specific scorecard by its ID.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/scorecards/:scorecard_id`
  - Replace `:scorecard_id` with the actual scorecard ID you want to delete.
- **Method:** `DELETE`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
No request body is required for this API call.

---

## **Description**
- This API call deletes the scorecard specified by the `scorecard_id`.
- Once the scorecard is deleted, it will no longer be available for retrieval or editing.
  
**Important Notes:**
- Ensure that the `Authorization` header contains a valid token for authentication.
- Once a scorecard is deleted, it cannot be undone, so use with caution.
</details>

### Templates
Manage various templates used in job postings, emails, and other communications.

#### Email Templates

<details>
<summary>Create Email Template API Call</summary>

## **Purpose**
Creates a new email template with a name, subject, and body content.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/email-templates`
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must be sent as `application/x-www-form-urlencoded` with the following fields:

| **Field**           | **Type**   | **Description**                             |
|---------------------|-----------|---------------------------------------------|
| `template_name`     | `string`  | The name of the email template.             |
| `template_subject`  | `string`  | The subject of the email template.          |
| `template_body`     | `string`  | The body content of the email template, in HTML format. |

**Note:**
- Ensure the `template_body` is properly formatted in HTML.

---

## **Description**
- This API call creates a new email template with the provided name, subject, and body content.
- The `template_body` can contain HTML elements such as `<h3>`, `<p>`, etc.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token for authentication.
- Any script tags or unsafe content should be properly sanitized before being sent.
  
</details>

<details>
<summary>Update Email Template API Call</summary>

## **Purpose**
Updates an existing email template with new values for the template name, subject, and body content.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/email-templates/:email_template_id`
  - Replace `:email_template_id` with the ID of the email template you want to update.
- **Method:** `PUT`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must be sent as `application/x-www-form-urlencoded` with the following fields:

| **Field**           | **Type**   | **Description**                             |
|---------------------|-----------|---------------------------------------------|
| `template_name`     | `string`  | The new name of the email template.         |
| `template_subject`  | `string`  | The new subject of the email template.      |
| `template_body`     | `string`  | The new body content of the email template, in HTML format. |

**Note:**
- Ensure the `template_body` is properly formatted in HTML.

---

## **Description**
- This API call updates an existing email template with the provided name, subject, and body content.
- The `template_body` should be properly sanitized to avoid XSS vulnerabilities, especially if it includes script tags.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token for authentication.
- Replace `:email_template_id` with the actual ID of the email template you want to update.

</details>

<details>
<summary>Get Email Template API Call</summary>

## **Purpose**
Fetches an existing email template by its ID, providing details like the template's name, subject, and body content.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/email-templates/:email_template_id`
  - Replace `:email_template_id` with the ID of the email template you want to retrieve.
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
- This API call does not require a request body.

---

## **Description**
- This API call retrieves the details of a specific email template by its ID.
- The response will include the `template_name`, `template_subject`, and `template_body`.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token for authentication.
- Replace `:email_template_id` with the actual ID of the email template you want to fetch.

</details>

<details>
<summary>List Email Templates API Call</summary>

## **Purpose**
Fetches a list of all available email templates in the system, including their details such as name, subject, and body content.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/email-templates`
  - No template ID is required in the URL.
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
- This API call does not require a request body.

---

## **Description**
- This API call retrieves a list of all email templates available in the system.
- The response will include an array of email templates with their `template_name`, `template_subject`, and `template_body`.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token for authentication.

</details>

<details>
<summary>Delete Email Template API Call</summary>

## **Purpose**
Deletes a specific email template by its ID.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/email-templates/:email_template_id`
  - Replace `:email_template_id` with the ID of the email template you want to delete.
- **Method:** `DELETE`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
- This API call does not require a request body.

---

## **Description**
- This API call deletes an email template based on the specified template ID.
- Ensure the template ID in the URL is correct before making the request.

**Important Notes:**
- Only the email template with the specified ID will be deleted.
- Ensure the `Authorization` header contains a valid token for authentication.

</details>

#### SMS Templates

<details>
<summary>Create SMS Template API Call</summary>

## **Purpose**
Creates a new SMS template with the provided name and content.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/sms-templates`
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must be sent as `application/x-www-form-urlencoded` with the following fields:

| **Field**         | **Type**   | **Description**                                     |
|-------------------|-----------|-----------------------------------------------------|
| `name`            | `string`  | The name of the SMS template.                       |
| `content`         | `string`  | The content (body) of the SMS template.             |

**Note:**
- `name` and `content` are required fields.

---

## **Description**
- This API call creates a new SMS template in the system with the specified `name` and `content`.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token for authentication.
- Make sure that both `name` and `content` are properly populated.

</details>

<details>
<summary>Update SMS Template API Call</summary>

## **Purpose**
Updates an existing SMS template with the provided `name` and `content`.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/sms-templates/:id`
  - Replace `:id` with the ID of the SMS template to be updated.
- **Method:** `PUT`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must be sent as `application/x-www-form-urlencoded` with the following fields:

| **Field**         | **Type**   | **Description**                                     |
|-------------------|-----------|-----------------------------------------------------|
| `name`            | `string`  | The new name of the SMS template.                   |
| `content`         | `string`  | The new content (body) of the SMS template.         |

**Note:**
- `name` and `content` are required fields for the update.

---

## **Description**
- This API call updates the SMS template with the specified `id` by modifying its `name` and `content`.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token for authentication.
- The `id` parameter should be replaced with the ID of the SMS template you wish to update.

</details>

<details>
<summary>Get SMS Template by ID API Call</summary>

## **Purpose**
Retrieves an SMS template by its unique ID.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/sms-templates/:id`
  - Replace `:id` with the ID of the SMS template you want to retrieve.
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This request does not require a request body.

---

## **Description**
- This API call retrieves the SMS template with the specified `id`.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token for authentication.
- The `id` parameter should be replaced with the ID of the SMS template you wish to retrieve.

</details>

<details>
<summary>List All SMS Templates API Call</summary>

## **Purpose**
Retrieves a list of all SMS templates.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/sms-templates`
  - This endpoint fetches all SMS templates.
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This request does not require a request body.

---

## **Description**
- This API call retrieves a list of all SMS templates.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token for authentication.

</details>

<details>
<summary>Delete SMS Template API Call</summary>

## **Purpose**
Deletes an existing SMS template by its ID.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/sms-templates/:id`
  - Replace `:id` with the actual ID of the SMS template you want to delete.
- **Method:** `DELETE`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This request does not require a request body.

---

## **Description**
- This API call deletes the SMS template with the specified ID.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token for authentication.

</details>

#### Offer Templates

<details>
<summary>Create Offer Template API Call</summary>

## **Purpose**
Creates a new offer template.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/offer-templates`
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This request does not require a request body.

---

## **Description**
- This API call creates a new offer template. No specific data fields are provided in the request body in the example.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token for authentication.

</details>

<details>
<summary>Update Offer Template API Call</summary>

## **Purpose**
Updates an existing offer template with new values.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/offer-templates/:id`
  - Replace `:id` with the offer template ID.
- **Method:** `PUT`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must be sent as `application/x-www-form-urlencoded` with the following fields:

| **Field**          | **Type**   | **Description**                              |
|--------------------|-----------|----------------------------------------------|
| `template_name`    | `string`  | The updated name of the offer template.      |
| `template_subject` | `string`  | The updated subject for the offer template.  |
| `template_body`    | `string`  | The updated body content for the offer template. |

---

## **Description**
- This API call updates the existing offer template with the new name, subject, and body.
- You must provide the template ID in the URL and include the updated fields in the request body.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token for authentication.

</details>

<details>
<summary>Get Offer Template API Call</summary>

## **Purpose**
Retrieves details of a specific offer template based on the provided template ID.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/offer-templates/:id`
  - Replace `:id` with the offer template ID.
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
- **This request does not require a body.**

---

## **Description**
- This API call retrieves an offer template by its ID, returning the details of the template, including its name, subject, and body.
  
**Important Notes:**
- Ensure that the `Authorization` header contains a valid token for authentication.

</details>

<details>
<summary>List Offer Templates API Call</summary>

## **Purpose**
Retrieves a list of all available offer templates.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/offer-templates`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
- **This request does not require a body.**

---

## **Description**
- This API call fetches all available offer templates from the system. It returns a list of templates, each containing details such as the name, subject, and body of the offer.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token for authentication.

</details>

<details>
<summary>Delete Offer Template API Call</summary>

## **Purpose**
Deletes a specific offer template identified by its `id`.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/offer-templates/:id`
  - Replace `:id` with the unique identifier of the offer template to delete.
- **Method:** `DELETE`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
- **This request does not require a body.**

---

## **Description**
- This API call removes the offer template with the specified `id` from the system.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token for authentication.
- Deleting an offer template is permanent and cannot be undone.

</details>

#### Job Description Templates

<details>
<summary>Create Job Description Template API Call</summary>

## **Purpose**
Creates a new job description template with a specified job title and description.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/job-description-templates`
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must be sent as `application/x-www-form-urlencoded` with the following fields:

| **Field**         | **Type**   | **Description**                                     |
|-------------------|-----------|-----------------------------------------------------|
| `job_title`       | `string`  | The title of the job for the job description template. |
| `job_description` | `string`  | The detailed description of the job for the template. |

**Note:**
- Make sure the `job_title` and `job_description` fields are provided.

---

## **Description**
- This API call creates a job description template with the provided title and description, which can be used for job postings and other recruitment purposes.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token for authentication.
- The `Content-Type` header must be set to `application/x-www-form-urlencoded`.

</details>
<details>
<summary>Update Job Description Template API Call</summary>

## **Purpose**
Updates an existing job description template with a new job title and description.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/job-description-templates/:id`
  - Replace `:id` with the unique ID of the job description template you want to update.
- **Method:** `PUT`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must be sent as `application/x-www-form-urlencoded` with the following fields:

| **Field**         | **Type**   | **Description**                                     |
|-------------------|-----------|-----------------------------------------------------|
| `job_title`       | `string`  | The updated job title for the job description template. |
| `job_description` | `string`  | The updated detailed description of the job for the template. |

**Note:**
- Make sure the `job_title` and `job_description` fields are provided to successfully update the template.

---

## **Description**
- This API call updates an existing job description template using the provided job title and description.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token for authentication.
- The `Content-Type` header must be set to `application/x-www-form-urlencoded`.
- Replace `:id` in the URL with the ID of the job description template you wish to update.

</details>

<details>
<summary>Get Job Description Template API Call</summary>

## **Purpose**
Retrieves the details of a specific job description template based on its ID.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/job-description-templates/:id`
  - Replace `:id` with the unique ID of the job description template you want to retrieve.
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This request does not require a body.

---

## **Description**
- This API call retrieves a job description template by its unique ID.
- You will get the job title and job description associated with the given template ID.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token for authentication.
- Replace `:id` in the URL with the ID of the job description template you wish to retrieve.

</details>

<details>
<summary>List Job Description Templates API Call</summary>

## **Purpose**
Retrieves a list of all available job description templates.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/job-description-templates`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This request does not require a body.

---

## **Description**
- This API call retrieves a list of all job description templates.
- The response includes the job title and job description for each template.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token for authentication.

</details>

<details>
<summary>Delete Job Description Template API Call</summary>

## **Purpose**
Deletes a specific job description template by its ID.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/job-description-templates/:id`
  - Replace `:id` with the ID of the job description template you want to delete.
- **Method:** `DELETE`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This request does not require a body.

---

## **Description**
- This API call deletes a specific job description template identified by its unique `id`.
- Upon success, the template will be removed from the system.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token for authentication.
- Replace `:id` in the URL with the ID of the job description template you wish to delete.

</details>

#### System Email Templates

<details>
<summary>Update System Template API Call</summary>

## **Purpose**
Updates the subject and body content of a specific system template by its ID.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/system-templates/:template_id`
  - Replace `:template_id` with the ID of the system template you want to update.
- **Method:** `PUT`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must be sent as `application/x-www-form-urlencoded` with the following fields:

| **Field**             | **Type**  | **Description**                                                                                             |
|-----------------------|-----------|-------------------------------------------------------------------------------------------------------------|
| `template_subject`    | `string`  | The subject line for the template.                                                                           |
| `template_body`       | `string`  | The body content for the template. You can use placeholders like `%first-name%`, `%job-title%`, and `%company-name%`. |

**Note:**
- Ensure that the template contains placeholders (e.g., `%first-name%`) for dynamic values.
- Replace the placeholders with the actual values when using the template.

---

## **Description**
- This API call updates an existing system template identified by its `template_id`.
- The template's subject and body are updated with the new values provided in the request.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid token for authentication.
- Replace `:template_id` in the URL with the ID of the template you wish to update.

</details>

<details>
<summary>Get System Template API Call</summary>

## **Purpose**
This API call retrieves a specific system template by its ID.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/system-templates/:template_id`
  - Replace `:template_id` with the actual ID of the system template you want to retrieve.
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This request does not require a body.

---

## **Description**
- This endpoint allows you to retrieve a system template by its unique template ID.
- The response will contain the details of the template if it exists and is accessible with the provided access token.

**Important Notes:**
- Replace `:template_id` in the URL with the actual template ID you wish to retrieve.

</details>

<details>
<summary>Get All System Templates API Call</summary>

## **Purpose**
This API call retrieves all system templates available.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/system-templates`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This request does not require a body.

---

## **Description**
- This endpoint retrieves all system templates that are available within the VIVAHR system.
- The response will return a list of templates if they exist and are accessible with the provided access token.

**Important Notes:**
- Ensure that a valid access token is used to authenticate the request.

</details>

### Culture Profiles
Access and manage culture profiles to help candidates understand your organization's culture.

<details>
<summary>Create Culture Profile API Call</summary>

## **Purpose**
This API call creates a new culture profile, including attributes like the profile name, type, hero image, and other related details.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/culture-profile`
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `multipart/form-data`            | Specifies that the request body contains form data. |

---

## **Request Body**
The request body must include form data with the following fields:

| **Field**               | **Type**          | **Description**                                      |
|-------------------------|-------------------|------------------------------------------------------|
| `culture_profile_name`   | String            | The name of the culture profile.                     |
| `culture_profile_type`   | String            | Type of the culture profile (e.g., Hero Image or Photo). |
| `video_url`              | String            | A URL for the video (if applicable).                 |
| `hero_image`             | File              | A file representing the hero image (uploaded via form). |
| `about_us`               | String            | A description of the company or organization.        |

---

## **Description**
- This endpoint allows you to create a culture profile by submitting the relevant details via a `POST` request. 
- The profile includes fields such as name, type, a hero image, a video URL, and an "about us" description.
- The request requires the use of `multipart/form-data` to handle the file upload for `hero_image`.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.
- The `hero_image` should be a file input field containing a valid image file.

</details>

<details>
<summary>Create Culture Profile - Expanded API Call</summary>

## **Purpose**
This API call creates a new culture profile with additional expanded image options, such as large and small images, along with the profile name, type, hero image, and other related details.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/culture-profile`
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `multipart/form-data`            | Specifies that the request body contains form data. |

---

## **Request Body**
The request body must include form data with the following fields:

| **Field**               | **Type**          | **Description**                                      |
|-------------------------|-------------------|------------------------------------------------------|
| `culture_profile_name`   | String            | The name of the culture profile.                     |
| `culture_profile_type`   | String            | Type of the culture profile (e.g., Expanded).        |
| `video_url`              | String            | A URL for the video (if applicable).                 |
| `hero_image`             | File              | A file representing the hero image (uploaded via form). |
| `about_us`               | String            | A description of the company or organization.        |
| `expanded_image_large`   | File              | A large image used for the expanded profile.         |
| `expanded_image_small_1` | File              | A small image used for the expanded profile (small 1). |
| `expanded_image_small_2` | File              | A small image used for the expanded profile (small 2). |

---

## **Description**
- This endpoint allows you to create a culture profile with an expanded set of images, including large and small images, by submitting the relevant details via a `POST` request. 
- The profile includes fields such as name, type, hero image, a video URL, "about us" description, and additional expanded images for visual representation.
- The request requires the use of `multipart/form-data` to handle the file uploads for `hero_image`, `expanded_image_large`, and the small images.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.
- The `hero_image`, `expanded_image_large`, `expanded_image_small_1`, and `expanded_image_small_2` fields should contain valid image file inputs.

</details>

<details>
<summary>Create Culture Profile - Expanded Plus API Call</summary>

## **Purpose**
This API call creates a new culture profile with an extended set of attributes, including testimonials, additional text, executive profiles, and expanded image options such as large and small images. The profile can also include a hero image, video URL, and company description.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/culture-profile`
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `multipart/form-data`            | Specifies that the request body contains form data. |

---

## **Request Body**
The request body must include form data with the following fields:

| **Field**                     | **Type**          | **Description**                                      |
|-------------------------------|-------------------|------------------------------------------------------|
| `culture_profile_name`         | String            | The name of the culture profile.                     |
| `culture_profile_type`         | String            | Type of the culture profile (e.g., Expanded Plus).   |
| `video_url`                    | String            | A URL for the video (if applicable).                 |
| `hero_image`                   | File              | A file representing the hero image (uploaded via form). |
| `about_us`                     | String            | A description of the company or organization.        |
| `expanded_image_large`         | File              | A large image used for the expanded profile.         |
| `expanded_image_small_1`       | File              | A small image used for the expanded profile (small 1). |
| `expanded_image_small_2`       | File              | A small image used for the expanded profile (small 2). |
| `testimonial[0][name]`         | String            | Name of the first testimonial.                       |
| `testimonial[0][body]`         | String            | Body of the first testimonial.                       |
| `testimonial[1][name]`         | String            | Name of the second testimonial.                      |
| `testimonial[1][body]`         | String            | Body of the second testimonial.                      |
| `testimonial[2][name]`         | String            | Name of the third testimonial.                       |
| `testimonial[2][body]`         | String            | Body of the third testimonial.                       |
| `additional_text`              | String            | Additional text to be included in the profile.       |
| `executive_profile[name]`      | String            | Name of the executive profile (optional).            |
| `executive_profile[summary]`   | String            | Summary of the executive profile.                    |
| `executive_profile[image]`     | File              | A file representing the executive's image (uploaded via form). |

---

## **Description**
- This endpoint allows you to create a culture profile with a rich set of attributes, including testimonials, executive profiles, images, and additional text fields. 
- The profile includes fields such as the profile name, type, hero image, expanded images, video URL, testimonials, executive profile, and a description of the company or organization.
- The request requires the use of `multipart/form-data` to handle file uploads for `hero_image`, `expanded_image_large`, `expanded_image_small_1`, `expanded_image_small_2`, and the `executive_profile[image]`.
- The testimonials are submitted as an array of objects, and the executive profile includes a name, summary, and an image.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.
- The `hero_image`, `expanded_image_large`, `expanded_image_small_1`, `expanded_image_small_2`, and `executive_profile[image]` fields should contain valid image file inputs.
- The `testimonial` fields should be provided as an array of name and body pairs.

</details>

<details>
<summary>Get Culture Profile API Call</summary>

## **Purpose**
This API call retrieves details for an existing culture profile using its unique profile ID. The profile includes various attributes like name, type, images, testimonials, and executive profiles.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/culture-profile/:profileID`
  - Replace `:profileID` with the ID of the culture profile you want to retrieve.
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This request does not require a body.

---

## **Description**
- This endpoint allows you to retrieve the details of a specific culture profile using the profile's unique ID.
- The profile includes attributes such as the profile name, type, hero image, expanded images, video URL, testimonials, executive profiles, and additional information.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.
- Replace `:profileID` in the URL with the actual culture profile ID you wish to retrieve.

</details>

<details>
<summary>Get All Culture Profiles API Call</summary>

## **Purpose**
This API call retrieves a list of all culture profiles available. It returns details for each profile, including the profile name, type, images, video URL, testimonials, executive profiles, and more.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/culture-profile`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This request does not require a body.

---

## **Description**
- This endpoint allows you to retrieve a list of all culture profiles available in the system.
- The response will include the details of each profile, such as name, type, images, video URL, testimonials, and executive profile data.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.

</details>

<details>
<summary>Delete Culture Profile API Call</summary>

## **Purpose**
This API call deletes a specific culture profile by its ID.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/culture-profile/:profileID`
  - Replace `:profileID` with the ID of the culture profile you want to delete.
- **Method:** `DELETE`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This request does not require a body.

---

## **Description**
- This endpoint allows you to delete a culture profile by providing its `profileID` in the URL.
- Upon successful deletion, the profile will no longer be available in the system.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.
- The `profileID` should be a valid culture profile ID that exists in the system.

</details>

### **Questionnaires**
Create and manage questionnaires for candidates to gather more detailed information.

<details>
<summary>Create Questionnaire API Call</summary>

## **Purpose**
This API call creates a new questionnaire with a set of questions, including various types of question formats like essay, multiple-choice, and yes/no questions.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/questionnaires`
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Specifies that the request body is sent as URL-encoded form data. |

---

## **Request Body**
The request body should contain the questionnaire name and an array of questions with their respective types, questions, and options.

| **Field**                 | **Type**          | **Description**                                    |
|---------------------------|-------------------|----------------------------------------------------|
| `name`                    | String            | The name of the questionnaire.                     |
| `questions[x][type]`      | String            | The type of the question (e.g., Essay Question - Short, Multiple Choice). |
| `questions[x][question]`  | String            | The text of the question.                          |
| `questions[x][option][]`  | Array             | The available options for multiple-choice or yes/no questions. |
| `questions[x][knockout][]`| Array             | The knockout condition for each option.            |

**Note:**
- Replace `x` with the appropriate index for each question in the `questions` array.
- The `questions` array can contain various question types (e.g., Essay, Multiple Choice, Yes/No) with their corresponding options and knockout values.

---

## **Description**
- This endpoint creates a questionnaire by submitting the name and a series of questions in various formats.
- Each question can have different options and knockout conditions depending on its type.
- The request body must be sent as `application/x-www-form-urlencoded`.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.
- The questions must be correctly formatted with the appropriate `type`, `question`, `option`, and `knockout` values.

</details>

<details>
<summary>Update Questionnaire API Call</summary>

## **Purpose**
This API call updates an existing questionnaire with new details, including the name of the questionnaire and its questions.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/questionnaires/:form_id`
  - Replace `:form_id` with the ID of the questionnaire you wish to update.
- **Method:** `PUT`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Specifies that the request body is sent as URL-encoded form data. |

---

## **Request Body**
The request body should contain the updated questionnaire name and an array of questions, which can be modified or added.

| **Field**                 | **Type**          | **Description**                                    |
|---------------------------|-------------------|----------------------------------------------------|
| `name`                    | String            | The updated name of the questionnaire.             |
| `questions[x][type]`      | String            | The type of the question (e.g., Essay Question - Short, Essay Question - Long). |
| `questions[x][question]`  | String            | The updated text of the question.                  |

**Note:**
- Replace `x` with the appropriate index for each question in the `questions` array.
- You can update existing questions or add new ones by adjusting the array.

---

## **Description**
- This endpoint allows you to update an existing questionnaire by modifying its name and questions.
- The request body must be sent as `application/x-www-form-urlencoded` to update the questionnaire.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.
- You need to specify the correct questionnaire ID in the URL by replacing `:form_id` with the actual form ID.
- If the question index (`x`) doesn't exist, it will be treated as a new question.

</details>

<details>
<summary>Get Questionnaire API Call</summary>

## **Purpose**
This API call retrieves the details of an existing questionnaire, including its name and all associated questions.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/questionnaires/:form_id`
  - Replace `:form_id` with the ID of the questionnaire you wish to retrieve.
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This request does not require a body.

---

## **Description**
- This endpoint retrieves the details of an existing questionnaire by its ID.
- The response will include the questionnaire's name and a list of all questions associated with the questionnaire.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.
- You need to specify the correct questionnaire ID in the URL by replacing `:form_id` with the actual form ID.

</details>

<details>
<summary>Get All Questionnaires API Call</summary>

## **Purpose**
This API call retrieves a list of all available questionnaires.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/questionnaires`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This request does not require a body.

---

## **Description**
- This endpoint returns a list of all questionnaires available in the system.
- The response includes details such as the questionnaire name, questions, and their respective types.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.

</details>

<details>
<summary>Delete a Questionnaire API Call</summary>

## **Purpose**
This API call deletes a specific questionnaire by its ID.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/questionnaires/:form_id`
  - Replace `:form_id` with the actual ID of the questionnaire you want to delete.
- **Method:** `DELETE`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This request does not require a body.

---

## **Description**
- This endpoint allows you to delete a specific questionnaire from the system by providing its unique ID.
- Make sure to replace `:form_id` with the correct questionnaire ID in the URL.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.
- Deleting a questionnaire is a permanent action and cannot be undone.

</details>

### Candidate Tags
Utilize tags to organize and categorize candidates for easier management.

<details>
<summary>Create Tag API Call</summary>

## **Purpose**
This API call creates a new tag with a specified name.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/tags`
- **Method:** `POST`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must include the following fields:

| **Field**         | **Type**   | **Description**                                       |
|-------------------|-----------|-------------------------------------------------------|
| `tag`             | String    | The name of the tag to be created.                    |

**Note:**
- The `tag` field should contain a valid name for the tag, such as "api-test".

---

## **Description**
- This endpoint allows you to create a new tag by submitting the name of the tag via a `POST` request.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.

</details>

<details>
<summary>Update Tag API Call</summary>

## **Purpose**
This API call updates an existing tag by modifying its name.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/tags/:tag_id`
  - Replace `:tag_id` with the ID of the tag to be updated.
- **Method:** `PUT`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/x-www-form-urlencoded` | Indicates the content type of the request body. |

---

## **Request Body**
The request body must include the following fields:

| **Field**         | **Type**   | **Description**                                       |
|-------------------|-----------|-------------------------------------------------------|
| `tag`             | String    | The new name of the tag.                              |

**Note:**
- The `tag` field should contain the updated name for the tag.

---

## **Description**
- This endpoint allows you to update an existing tag by submitting the new tag name via a `PUT` request.
- The `:tag_id` placeholder in the URL must be replaced with the ID of the tag you wish to update.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.

</details>

<details>
<summary>Get Tag API Call</summary>

## **Purpose**
This API call retrieves details of a specific tag by its ID.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/tags/:tag_id`
  - Replace `:tag_id` with the ID of the tag to be retrieved.
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
This request does not require a body.

---

## **Description**
- This endpoint allows you to retrieve the details of a specific tag by specifying its ID in the URL.
- The `:tag_id` placeholder in the URL must be replaced with the actual tag ID.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.

</details>

<details>
<summary>Get Tags API Call</summary>

## **Purpose**
This API call retrieves a list of tags with optional filtering, sorting, and pagination. You can specify the number of results to return (`limit`), the starting point of results (`offset`), and the sorting direction (`sort_direction`).

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/tags`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |
| `Content-Type`  | `application/json`               | Specifies that the request body is in JSON format. |

---

## **Request Body**
The request body must include the following fields as JSON:

| **Field**          | **Type**     | **Description**                                      |
|--------------------|--------------|------------------------------------------------------|
| `limit`            | String       | The number of tags to retrieve (e.g., `"10"`).       |
| `offset`           | String       | The offset to start retrieving tags from (e.g., `"0"`). |
| `sort_direction`   | String       | The direction to sort the tags, either `"asc"` or `"desc"`. |

---

## **Description**
- This endpoint retrieves tags based on specified pagination, sorting, and filtering parameters.
- The `limit` specifies the number of tags to return, while `offset` helps to paginate through results.
- The `sort_direction` controls whether the results are sorted in ascending (`asc`) or descending (`desc`) order.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.
- The request body must be sent as a JSON string.

</details>

<details>
<summary>Delete Tag API Call</summary>

## **Purpose**
This API call deletes a specific tag by its unique `tag_id`. It is used to remove a tag from the system.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/tags/:tag_id`
  - Replace `:tag_id` with the actual tag ID that you want to delete.
- **Method:** `DELETE`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
- No request body is required for this API call.

---

## **Description**
- This endpoint deletes a tag identified by its unique `tag_id`. Once the tag is deleted, it cannot be recovered.
- You must specify the correct `tag_id` in the URL path to target the specific tag.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.
- Deleting a tag is permanent and cannot be undone.

</details>

### Helpers
Access helper functions that assist with various functionalities across the SDK.

<details>
<summary>Get Countries API Call</summary>

## **Purpose**
This API call retrieves a list of all available countries from the system. It is useful for populating country selection fields in applications.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/helpers/countries`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
- No request body is required for this API call.

---

## **Description**
- This endpoint retrieves a list of countries that can be used in forms or applications where a country field is needed. 
- The response typically contains country names along with any associated data such as country codes.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.

</details>

<details>
<summary>Get States API Call</summary>

## **Purpose**
This API call retrieves a list of all available states, typically useful for populating state selection fields in forms or applications.

---

## **Endpoint**
- **URL:** `https://auth.vivahr.com/v1/helpers/states`
- **Method:** `GET`

---

## **Headers**
| **Header**      | **Value**                       | **Description**                             |
|-----------------|----------------------------------|---------------------------------------------|
| `Authorization` | `Bearer YOUR_ACCESS_TOKEN`       | A valid access token for authentication.    |

---

## **Request Body**
- No request body is required for this API call.

---

## **Description**
- This endpoint retrieves a list of states, which can be used for form fields such as state dropdowns. 
- The list may include states or regions within a country, depending on the geographic context.

**Important Notes:**
- Ensure that the `Authorization` header contains a valid access token for authentication.

</details>

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