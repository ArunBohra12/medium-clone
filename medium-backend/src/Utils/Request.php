<?php

namespace App\Utils;

class Request {
  /**
   * Check for user input
   * If it is not json send back an error as a response otherwise set requestBody in the $_REQUEST variable
   */
  public function __construct() {
    $requestData = json_decode(file_get_contents('php://input'), true);

    if (json_last_error() !== JSON_ERROR_NONE) {
      $res = new Response(400, array('message' => 'Please only provide data in JSON format'));
      $res->setHeaders(array('Content-Type' => 'application/json'));
      $res->sendResponse();
    }

    $_REQUEST['requestBody'] = $requestData;
  }
}
