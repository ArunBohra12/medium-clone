<?php

namespace App\User;

use App\Utils\Response;
use UserInterface;

class User implements UserInterface {
  public function signup(): void {
    // TODO: Implement signup() method.
    $requestBody = $_REQUEST['requestBody'];
    $res = new Response(200, $requestBody);

    $res->setHeaders(array('Content-Type' => 'application/json'));
    $res->sendResponse();
  }

  public function login(): void {
    // TODO: Implement login() method.
  }
}
