<?php
  class Core {
    protected $controllerName = 'CadastroController';
    protected $controller;
    protected $method = 'index';
    protected $params = [];

    function start() {

      // Create array with url parameters
      $url = explode('/', $_GET['url']);

      // Get the controller name, converting first letter to uppercase
      $this->controllerName = ucwords($url[0]) . 'Controller';
      unset($url[0]);
      
      // If controller doesn't exist
      if(!file_exists('../app/controllers/' . $this->controllerName . '.php')) {
        echo 'Page not found.';
        exit();
      }

      // Require contoller
      require_once '../app/controllers/' . $this->controllerName . '.php';

      // Create controller
      $this->controller = new $this->controllerName;

      // If "method" parameter exist
      if(isset($url[1])) {
        // Set method
        $this->method = $url[1];

        // If method doesn't exist inside controller
        if(!method_exists($this->controller, $this->method)) {
          $this->method = 'index';
          echo "method não existe.";
        }

        unset($url[1]);
      }

      // Get params
      $this->params = $url ? array_values($url) : [];

      // Call controller with parameters
      call_user_func_array([$this->controller, $this->method], $this->params);
    }

  }


// URL format: http://Financy/controller/method/params