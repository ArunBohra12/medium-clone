<?php

namespace App\User;

use App\Utils\JwtUtils;
use mysqli;
use Ramsey\Uuid\Uuid;
use Exception;

use App\Utils\Response;
use Database\ConnectDB\ConnectDB;

class UserModel {
  private mysqli|null|false $connection;

  public function __construct() {
    $db = new ConnectDB();
    $this->connection = $db->connect();
  }

  /**
   * Checks if user exists.
   * If user exists send User otherwise send the response "User doesn't exist"
   * @param string $email
   * @return array
   */
  private function checkUserExists(string $email): array {
    try {
      $sql = $this->connection->prepare('SELECT * FROM users RIGHT JOIN login ON users.email = login.email WHERE users.email=?');
      $sql->bind_param('s', $email);

      $sql->execute();

      $result = $sql->get_result();
      $user = $result->fetch_assoc();

      $sql->close();

      if ($user === null) {
        $res = new Response(400, array(
          'message' => 'User with that email does not exist',
        ));
        $res->setHeaders(array('Content-Type' => 'application/json'))->sendResponse();
      }

      return $user;
    } catch (Exception $exception) {
      Response::sendUncaughtException($exception);
    }
  }

  /**
   * Signs a JWT and sends it to the client in order to log the user in
   * @param string $userId
   * @return void
   */
  private function signAndSendToken(string $userId): void {
    $jwt = new JwtUtils();
    $token = $jwt->encodeJwt(array('id' => $userId));

    $res = new Response(200, array(
      'jwt' => $token
    ));
    $res->setHeaders(array('Content-Type' => 'application/json'))->sendResponse();
  }

  /**
   * Create a UUID and password hash for user and do signup
   * @param string $name
   * @param string $email
   * @param string $password
   * @return void
   * @throws Exception
   */
  public function signup(string $name, string $email, string $password): void {
    try {
      $userId = Uuid::uuid4();
      $hashOptions = array('cost' => 12);
      $passwordHash = password_hash($password, PASSWORD_BCRYPT, $hashOptions);

      $usersSql = $this->connection->prepare("INSERT INTO users (id, name, email) VALUES (?, ?, ?)");
      $usersSql->bind_param("sss", $userId, $name, $email);

      $loginSql = $this->connection->prepare('INSERT INTO login (email, password) VALUES (?, ?)');
      $loginSql->bind_param('ss', $email, $passwordHash);

      $usersSql->execute();
      $loginSql->execute();

      $usersSql->close();
      $loginSql->close();

      // Send the token to the client to log them in
      $this->signAndSendToken($userId);
    } catch (Exception $exception) {
      Response::sendUncaughtException($exception);
    }
  }

  /**
   * Checks if user exists and logs him in
   * @throws Exception
   */
  public function login(string $email, string $password): void {
    $user = $this->checkUserExists($email);
    $isPasswordCorrect = password_verify($password, $user['password']);

    if (!$isPasswordCorrect) {
      $res = new Response(401, array(
        'message' => 'Wrong email or password',
      ));
      $res->setHeaders(array('Content-Type' => 'application/json'))->sendResponse();
    }

    // Send the jwt to the client
    $this->signAndSendToken($user['id']);
  }


  /**
   * Checks if user is logged in or not
   * @param string $token
   * @return void
   */
  public function protect(string $token): void {
    try {
      // Decode and verify the token
      $jwt = new JwtUtils();
      $decodedToken = json_decode(json_encode($jwt->decodeJwt($token)), true);

      // Check if the user with the id exists
      $sql = $this->connection->prepare('SELECT * FROM users WHERE users.id=?');
      $sql->bind_param('s', $decodedToken['id']);
      $sql->execute();
      $result = $sql->get_result();
      $user = $result->fetch_assoc();
      $sql->close();

      if ($user === null) {
        $res = new Response(400, array(
          'message' => 'User does not exist',
        ));
        $res->setHeaders(array('Content-Type' => 'application/json'))->sendResponse();
      }

      $_REQUEST['currentUser'] = $user;
    } catch (Exception $exception) {
      Response::sendUncaughtException($exception);
    }
  }

  // Close the DB connection
  public function __destruct() {
    $this->connection->close();
  }
}
