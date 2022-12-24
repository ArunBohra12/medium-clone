<?php

use App\Router\Router;
use App\User\User;
use Database\Connect\Connect;

// Have everyone access the application
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

$router = new Router($_SERVER);

$user = new User();

// -------------------------------
// REGISTER THE ROUTES

$router->post('/users', function () use ($user) {
  $user->signup();
});

$router->get('/users', function () use ($user) {
  $user->login();
});

$router->run();
