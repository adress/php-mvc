<?php

require "../vendor/autoload.php";

use Core\Router;

$uri = helper()->uri_remove_first(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));

$verb = $_SERVER['REQUEST_METHOD'];

$router = new Router($uri, $verb);