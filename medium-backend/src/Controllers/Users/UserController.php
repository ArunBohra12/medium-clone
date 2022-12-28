<?php

namespace App\User;

use App\Utils\Response;
use UserInterface;

class UserController implements UserInterface {
  private UserModel $user;

  public function __construct() {
    $this->user = new UserModel();
  }

  /**
   * Validates if user details are valid
   * If yes then do nothing otherwise send a failed response
   * @param string $name
   * @param string $email
   * @param string $password
   * @return void
   */
  private function validateUserDetails(string $name, string $email, string $password): void {
    if (empty($name) || empty($email) || empty($password)) {
      $res = new Response(400, array(
        'message' => 'Please provide all of the details',
      ));
      $res->setHeaders(array('Content-Type' => 'application/json'))->sendResponse();
    }

    if (strlen($password) < 8) {
      $res = new Response(400, array(
        'message' => 'Password should be at least 8 characters long',
      ));
      $res->setHeaders(array('Content-Type' => 'application/json'))->sendResponse();
    }
  }

  /**
   * @throws \Exception
   */
  public function signup(): void {
    $requestBody = $_REQUEST['requestBody'];

    $name = $requestBody['name'];
    $email = $requestBody['email'];
    $password = $requestBody['password'];


    $this->validateUserDetails($name, $email, $password);

    $this->user->signup($name, $email, $password);
  }

  /**
   * @throws \Exception
   */
  public function login(): void {
    $requestBody = $_REQUEST['requestBody'];

    $email = $requestBody['email'];
    $password = $requestBody['password'];

    if (strlen(empty($email) || empty($password))) {
      $res = new Response(400, array(
        'message' => 'Please provide all the details',
      ));
      $res->setHeaders(array('Content-Type' => 'application/json'))->sendResponse();
    }

    $this->user->login($email, $password);
  }
}
