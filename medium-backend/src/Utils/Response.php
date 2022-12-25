<?php

namespace App\Utils;

// All the response statuses
const STATUSES = array(
  '2' => 'success',
  '4' => 'fail',
  '5' => 'error',
);

class Response {
  private int $statusCode; // Status code for the response
  private string $status; // Status of the request
  private array $responseData; // The response body

  private array $responseHeaders = array(); // Headers to be sent with the response

  public function __construct(int $statusCode, array $responseData) {
    $this->statusCode = $statusCode;
    $this->responseData = $responseData;

    $statusCodeInitial = ((string) $statusCode)[0];
    $this->status = !empty(STATUSES[$statusCodeInitial]) ? STATUSES[$statusCodeInitial] : '';
  }

  /**
   * Set headers in the $this->responseHeaders variables
   * @param array $headers (key will be the header name and value will be the header value)
   * @return Response
   */
  public function setHeaders(array $headers): Response {
    foreach ($headers as $headerName => $headerValue) {
      $this->responseHeaders[$headerName] = $headerValue;
    }

    return $this;
  }

  /**
   * Set response code, headers and body for the request
   * @return never
   */
  public function sendResponse(): never {
    http_response_code($this->statusCode);

    foreach ($this->responseHeaders as $headerName => $headerValue) {
      header("$headerName: $headerValue");
    }

    $responseData = array(
      'status' => $this->status,
      'data' => $this->responseData,
    );

    print_r(json_encode($responseData));
    exit;
  }
}
