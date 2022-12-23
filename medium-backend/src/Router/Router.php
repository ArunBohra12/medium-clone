<?php

namespace App\Router;

use Closure;

class Router {
  private string $endpoint;
  private string $method;

  private array $routes = array(
    'GET' => array(),
    'POST' => array(),
  );

  public function __construct(array $request) {
    $this->endpoint = $request['REQUEST_URI'];
    $this->method = $request['REQUEST_METHOD'];
  }

  private function isRouteRegistered(string $endPoint): bool {
    if (!array_key_exists($this->method, $this->routes)) {
      return false;
    }

    return array_key_exists($endPoint, $this->routes[$this->method]);
  }

  public function get(string $route, Closure $callback): void {
    $this->routes['GET'][$route] = $callback;
  }

  public function post(string $route, Closure $callback): void {
    $this->routes['POST'][$route] = $callback;
  }

  public function run(): void {
    if (!$this->isRouteRegistered($this->endpoint)) {
      return;
    }

    $this->routes[$this->method][$this->endpoint]->call($this);
  }
}
