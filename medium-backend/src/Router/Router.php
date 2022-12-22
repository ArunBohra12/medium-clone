<?php

namespace App\Router;

class Router {
  public string $request;

  // The $routes array will contain our URI's and callbacks.
  public array $routes = [];

  public function __construct(array $request) {
    $this->request = basename($request['REQUEST_URI']);
  }

  // Returns true or false based on if uri exists in $this->routes array
  private function hasRoute(string $uri) : bool {
    return array_key_exists($uri, $this->routes);
  }

  // Add a route and a callback to our $routes array.
  public function addRoute(string $uri, \Closure $func): void {
    $this->routes[$uri] = $func;
  }

  public function run(): void {
    if($this->hasRoute($this->request)) {
      $this->routes[$this->request]->call($this);
    }
  }
}