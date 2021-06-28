<?php

require "../vendor/autoload.php";

use Core\Router;

//load .env
$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

//configure router
$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$uri = $_ENV['BASE_DIR'] ? Helper::uri_remove_first($uri) : $uri;
$verb = $_SERVER['REQUEST_METHOD'];
$router = new Router($uri, $verb);