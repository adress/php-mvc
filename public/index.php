<?php

require "../vendor/autoload.php";

use Core\Router;

$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$verb = $_SERVER['REQUEST_METHOD'];

$router = new Router($uri, $verb);  

$controller = $router->getController();
$method = $router->getAction();
$request = $router->getRequest();
$controller->$method($request);