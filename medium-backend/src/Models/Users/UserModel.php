<?php

namespace App\User;

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
   * Create a UUID and password hash for user and do signup
   * @param string $name
   * @param string $email
   * @param string $password
   * @return array
   * @throws Exception
   */
  public function signup(string $name, string $email, string $password): array {
    try {
      $userId = Uuid::uuid4();
      $hashOptions = array('cost' => 12);
      $passwordHash = password_hash($password, PASSWORD_BCRYPT, $hashOptions);

      $usersSql = $this->connection->prepare("INSERT INTO users (id, name, email) VALUES (?, ?, ?)");
      $usersSql->bind_param("sss", $userId, $name, $email);

      $loginSql = $this->connection->prepare('INSERT INTO login (email, password) VALUES (?, ?)');
      $loginSql->bind_param('ss', $email, $password);

      $usersSql->execute();
      $loginSql->execute();

      $usersSql->close();
      $loginSql->close();

      return array('pass' => $passwordHash, 'user' => array(
        'id' => $userId,
        'name' => $name,
        'email' => $email
      ));
    } catch (Exception $exception) {
      $res = new Response(500, array(
        'message' => $exception->getMessage(),
      ));
      $res->setHeaders(array('Content-Type' => 'application/json'))->sendResponse();
    }
  }

  // Close the DB connection
  public function __destruct() {
    $this->connection->close();
  }
}
