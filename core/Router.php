<?php

namespace Core;

use App\Controllers\HomeController;

class Router
{
  private $uri;
  private $controller;
  private $action;
  private $url_params = [];
  private $routes;
  private $verb;

  public function __construct(string $uri, string $verb)
  {
    $this->uri = $uri;
    $this->verb = $verb;

    $this->init_routes();
    $this->configureURI();
  }

  private function init_routes()
  {

    $this->routes =
      [
        ['verb' => 'GET', 'uri' => '/home', 'action' => 'index', 'controller' => HomeController::class],
        ['verb' => 'GET', 'uri' => '/home/{id}', 'action' => 'show', 'controller' => HomeController::class],
      ];
  }

  public function configureURI()
  {
    $actual_route = null;
    //filter routes for verb
    $verb_routes = array_filter($this->routes, function ($ruta) {
      return $this->verb == $ruta['verb'];
    });

    //find the route
    foreach ($verb_routes as $route) {
      $pattern = preg_replace('#{\w+}#', '[0-9]+', "#^{$route['uri']}$#");
      if (preg_match($pattern, $this->uri)) {
        $actual_route = $route;
        $this->action = $route['action'];
        $this->controller = $route['controller'];
        break;
      }
    }

    //get url params like {id}
    $urlArray = explode('/', $actual_route['uri']);
    preg_match_all('#{\w+}#', $actual_route['uri'], $matches);

    //set pamater url into key-array
    foreach ($matches[0] as $match) {
      $index = array_search($match, $urlArray);
      $this->url_params[trim($match, "{}")] = explode('/', $this->uri)[$index];
    }
  }

  public function getUri()
  {
    return $this->uri;
  }

  public function getController()
  {
    return new $this->controller();
  }

  public function getAction()
  {
    return $this->action;
  }

  public function getRequest()
  {
    $get = array_merge($_GET, $this->url_params);
    $post = $_POST;
    return array('get' => $get, 'post' => $post);
  }

  public function resolve()
  {
  }
}
