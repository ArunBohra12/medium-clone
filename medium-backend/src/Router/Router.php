<?php

namespace App\Router;

use App\Utils\Request;
use Closure;

class Router {
  private string $endpoint; // Current route on which request is being made to
  private string $method; // Request method

  // This will store the different handlers for different routes and methods
  // This is done so that we are able to call different functions on the same routes
  // but with different HTTP method
  private array $routes = array(
    'GET' => array(),
    'POST' => array(),
  );

  public function __construct(array $request) {
    $this->endpoint = $request['REQUEST_URI'];
    $this->method = $request['REQUEST_METHOD'];
    new Request();
  }

  /**
   * Checks if the route is registered in $this->routes
   * @param string $endPoint -> the route for on which request is being made
   * @return bool -> true if route is registered otherwise false
   */
  private function isRouteRegistered(string $endPoint): bool {
    if (!array_key_exists($this->method, $this->routes)) {
      return false;
    }

    return array_key_exists($endPoint, $this->routes[$this->method]);
  }

  /**
   * Register the get routes
   * @param string $route -> route for which the callback is registered
   * @param Closure $callback -> the callback function for the route
   */
  public function get(string $route, Closure $callback): void {
    $this->routes['GET'][$route] = $callback;
  }

  /**
   * Register the post routes
   * @param string $route -> route for which the callback is registered
   * @param Closure $callback -> the callback function for the route
   */
  public function post(string $route, Closure $callback): void {
    $this->routes['POST'][$route] = $callback;
  }

  /**
   * Checks if the current route is registered with a callback and runs the callback
   */
  public function run(): void {
    if (!$this->isRouteRegistered($this->endpoint)) {
      return;
    }

    $this->routes[$this->method][$this->endpoint]->call($this);
  }
}
