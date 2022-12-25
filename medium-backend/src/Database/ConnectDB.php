<?php

namespace Database\ConnectDB;

class ConnectDB {
  private string $host = 'localhost';
  private string $username = 'root';
  private string $password = 'arunbohra';
  private string $database = 'medium';

  public function connect() {
    $connection = mysqli_connect($this->host, $this->username, $this->password, $this->database);

    if ($connection->connect_error) {
      die('Database Error: Unable to connect to the database');
    }

    return $connection;
  }
}
