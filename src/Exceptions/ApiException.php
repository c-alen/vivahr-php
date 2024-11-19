<?php

namespace VIVAHR\Exceptions;

use Exception;

class ApiException extends Exception
{
    private $httpStatusCode;
    private $errorData;

    /**
     * ApiException constructor.
     *
     * @param string $message The exception message
     * @param int $code The exception code
     * @param int|null $httpStatusCode The HTTP status code (if applicable)
     * @param array $errorData Additional error data
     * @param Exception|null $previous Previous exception for chaining
     */
    public function __construct(
        string $message,
        int $code = 0,
        int $httpStatusCode = null,
        array $errorData = [],
        Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->httpStatusCode = $httpStatusCode;
        $this->errorData = $errorData;
    }

    /**
     * Log the exception details for debugging or tracking purposes.
     *
     * @return void
     */
    public function logError(): void
    {
        $logMessage = sprintf(
            "[%s] ApiException: %s | Code: %d | HTTP Status: %s | Data: %s\n",
            date('Y-m-d H:i:s'),
            $this->message,
            $this->code,
            $this->httpStatusCode ?? 'N/A',
            json_encode($this->errorData, JSON_PRETTY_PRINT)
        );

        // Log the error to a specific file or monitoring system
        error_log($logMessage, 3, __DIR__ . '/error_log.txt'); // or use another logging mechanism
    }

    /**
     * Get the HTTP status code associated with the exception, if available.
     *
     * @return int|null
     */
    public function getHttpStatusCode(): ?int
    {
        return $this->httpStatusCode;
    }

    /**
     * Retrieve any additional error data associated with the exception.
     *
     * @return array
     */
    public function getErrorData(): array
    {
        return $this->errorData;
    }

    /**
     * Custom string representation of the exception.
     *
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            "ApiException [%d]: %s | HTTP Status: %s",
            $this->code,
            $this->message,
            $this->httpStatusCode ?? 'N/A'
        );
    }
}