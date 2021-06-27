<?php

require "../vendor/autoload.php";

use Core\Router;

$uri_arr = explode("/", parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
unset($uri_arr[0], $uri_arr[1]);
$uri = "/" . implode("/", $uri_arr);

$verb = $_SERVER['REQUEST_METHOD'];

$router = new Router($uri, $verb);

$controller = $router->getController();
$method = $router->getAction();
$request = $router->getRequest();
$controller->$method($request);