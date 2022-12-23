<?php

use App\Router\Router;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

$router = new Router($_SERVER);

$post = new PostController();

$router->get('/posts', function () use ($post) {
  $post->getAllPosts();
});

$router->post('/posts', function () {
  print_r(file_get_contents('php://input'));
});

$router->run();
