<?php

namespace App\User;

use App\Utils\JwtUtils;
use Firebase\JWT\JWT;
use Ramsey\Uuid\Uuid;
use Exception;

use App\Utils\Response;
use Database\ConnectDB\ConnectDB;

class UserModel {
  private \mysqli|null|false $connection;

  public function __construct() {
    $db = new ConnectDB();
    $this->connection = $db->connect();
  }

  /**
   * Checks if user exist.
   * If user exists send User otherwise send the response "User doesn't exist"
   * @param string $email
   * @return array
   * @throws Exception
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

      $user = array(
        'id' => $userId,
        'name' => $name,
        'email' => $email
      );
      $res = new Response(200, array(
        'user' => $user,
      ));
      $res->setHeaders(array('Content-Type' => 'application/json'));
      $res->sendResponse();
    } catch (Exception $exception) {
      Response::sendUncaughtException($exception);
    }
  }

  /**
   * Checks if user exists and logs him in
   * @throws Exception
   */
  public function login(string $email, string $password): void {
    $this->protect();
    $user = $this->checkUserExists($email);
    $isPasswordCorrect = password_verify($password, $user['password']);

    if (!$isPasswordCorrect) {
      $res = new Response(401, array(
        'message' => 'Wrong email or password',
      ));
      $res->setHeaders(array('Content-Type' => 'application/json'))->sendResponse();
    }

    $jwt = new JwtUtils();
    $token = $jwt->encodeJwt(array('id' => $user['id']));

    $res = new Response(200, array(
      'jwt' => $token
    ));
    $res->setHeaders(array('Content-Type' => 'application/json'))->sendResponse();
  }

  // Close the DB connection
  public function __destruct() {
    $this->connection->close();
  }
}
