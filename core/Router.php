<?php

namespace Core;

use Exception;

class Router
{
  private string $uri;
  private string $verb;
  private ?array $actual_route = null;
  private array $routes = [];
  private array $url_params = [];

  public function __construct(string $uri, string $verb)
  {
    $this->uri = $uri;
    $this->verb = strtoupper($_POST['_method'] ?? $verb);
    $this->init_routes();
    $this->match_route();
    $this->resolve();
  }

  private function init_routes(): void
  {
    $this->routes = [
      ['verb' => 'GET', 'uri' => '/', 'action' => 'index', 'controller' => \App\Controllers\HomeController::class],
      ['verb' => 'GET', 'uri' => '/users/{user}', 'action' => 'show', 'controller' => \App\Controllers\HomeController::class],
      ['verb' => 'GET', 'uri' => '/convertir', 'action' => 'convertir', 'controller' => \App\Controllers\HomeController::class],
      // Agrega más rutas aquí...
    ];
  }

  private function match_route(): void
  {
    foreach ($this->routes as $route) {
      if ($route['verb'] !== $this->verb) continue;

      // Crear patrón de regex desde la URI
      $pattern = preg_replace_callback('#{(\w+)}#', function ($matches) {
        return '(?P<' . $matches[1] . '>[^/]+)';
      }, $route['uri']);

      $pattern = "#^{$pattern}$#";

      if (preg_match($pattern, $this->uri, $matches)) {
        $this->actual_route = $route;

        // Extraer los parámetros nombrados
        foreach ($matches as $key => $value) {
          if (!is_int($key)) {
            $this->url_params[$key] = $value;
          }
        }
        break;
      }
    }
  }

  private function getRequest(): array
  {
    $get = array_merge($_GET, $this->url_params);
    $post = ($this->verb === 'PUT') ? (parse_str(file_get_contents('php://input'), $put) ? $put : []) : $_POST;
    return ['get' => $get, 'post' => $post];
  }

  private function resolve(): void
  {
    try {
      if (!$this->actual_route) {
        throw new Exception("Ruta '{$this->uri}' no encontrada");
      }

      $controllerClass = $this->actual_route['controller'];
      $action = $this->actual_route['action'];

      if (!class_exists($controllerClass)) {
        throw new Exception("Controlador '{$controllerClass}' no encontrado");
      }

      $controller = new $controllerClass();

      if (!method_exists($controller, $action)) {
        throw new Exception("Método '{$action}' no existe en '{$controllerClass}'");
      }

      $params = $this->getRequest();

      // Llamada al controlador y acción
      echo $controller->$action($params);

    } catch (Exception $ex) {
      http_response_code(500);
      echo "Error: " . $ex->getMessage();
    }
  }
}
