<?php

namespace App\Utils;

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtUtils {
  private string $jwtSecret = 'jwt-secret-key';
  private string $algorithm = 'HS256';

  public function encodeJwt(array $payloadData): string {
    $payloadInfo = array(
      'iat' => time(),
      'exp' => time() + 360000
    );

    $payload = array_merge($payloadInfo, $payloadData);

    return JWT::encode($payload, $this->jwtSecret, $this->algorithm);
  }

  public function decodeJwt(string $jwt): \stdClass {
    return JWT::decode($jwt, new Key($this->jwtSecret, 'HS256'));
  }
}
