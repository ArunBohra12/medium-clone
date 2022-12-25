<?php

use App\Router\Router;
use App\User\UserController;

// Have everyone access the application
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

$router = new Router($_SERVER);

$user = new UserController();

// -------------------------------
// REGISTER THE ROUTES

$router->post('/users', function () use ($user) {
  $user->signup();
});

$router->get('/users', function () use ($user) {
  $user->login();
});

$router->run();
