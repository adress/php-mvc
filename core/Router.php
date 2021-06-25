<?php

namespace App\Core;

class Router{
  public $uri;
  public $controller;
  public $method;
  public $param;
  
  public function __construct($uri){
      $this->uri = $uri;
      $this->configureURI();
  }

  public function configureURI(){
    $url_array = explode('/', $this->uri);
    $this->controller = $url_array[2];
    $this->method = $url_array[3];   
    $this->param = $url_array[4];
  }

  public function getUri()
  {
    return $this->uri;
  }

  public function getController()
  {
    return $this->controller;
  }

  public function getMethod()
  {
    return $this->method;
  }

  public function getParam()
  {
    return $this->param;
  }

}