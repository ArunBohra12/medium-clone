<?php

use App\Router\Router;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

$router = new Router($_SERVER);
