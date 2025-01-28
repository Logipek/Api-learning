<?php
  namespace App;

  class Router {
    protected string $url;
    protected array $routes;

    public function __construct($routes) {
      $this->url = $_SERVER['REQUEST_URI'];
      $this->routes = $routes;

      $this->run();
    }

    protected function extractParams($url, $rule) {
      (array) $params = [];
      (array) $urlParts = explode('/', trim($url, '/'));
      (array) $ruleParts = explode('/', trim($rule, '/'));
      
      foreach($ruleParts as $index => $rulePart) {
        if (strpos($rulePart, ':') === 0 && isset($urlParts[$index])) {
          $paramName = substr($rulePart, 1);
          $params[$paramName] = $urlParts[$index];
        }
      }

      return $params;
    }

    protected function matchRule($url, $rule) {
      (array) $urlParts = explode('/', trim($url, '/'));
      (array) $ruleParts = explode('/', trim($rule, '/'));

      if (count($urlParts) !== count($ruleParts)) {
        return false;
      }

      foreach ($ruleParts as $index => $rulePart) {
        if ($rulePart !== $urlParts[$index] && strpos($rulePart, ':') !== 0) {
          return false; 
        }
      }

      return true;
    }
    protected function isMethodAllowed($controller, $method) {
      $allowedMethods = ['GET', 'POST', 'PUT', 'DELETE'];
      return in_array($method, $allowedMethods);
    }

    protected function run() {
      (bool) $is404 = true;
      (string) $url = parse_url($this->url, PHP_URL_PATH);
      (string) $method = $_SERVER['REQUEST_METHOD'];
    
      foreach ($this->routes as $route => $controller) {
        if ($this->matchRule($url, $route)) {
          (array) $params = $this->extractParams($url, $route);
          if ($this->isMethodAllowed($controller, $method)) {
            new $controller($params);
            $is404 = false;
            break;
          } else {
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/json; charset=utf-8');
            header('http/1.0 405 Method Not Allowed');
            echo json_encode([
              'code' => 405,
              'message' => 'Method Not Allowed'
            ]);
            return;
          }
        }
      }
      if ($is404) {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json; charset=utf-8');
        header('http/1.0 404 Not Found');
        echo json_encode([
          'code' => 404,
          'message' => 'Not found'
        ]);
      }
    }
  }