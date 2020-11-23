<?php
  class Core {
    protected $controllerName = 'CadastroController';
    protected $method = 'index';
    protected $params = [];
    
    protected $controller;

    function start() {
      $url = [];

      // If the URL exists
      if (isset($_GET['url'])) { 
        $url = $_GET['url'];

        // Create array with the url parameters
        $url = explode('/', $url);

        // If the user is logged in
        if (isLoggedIn()) {
          if ($url[0] === "cadastro" || $url[0] === "login") {
            header("Location:" . URLROOT . '/painel');
          }
        }

        // Get the controller name, converting first letter to uppercase
        $this->controllerName = ucwords($url[0]) . 'Controller';

        unset($url[0]);

        // If controller doesn't exist
        if(!file_exists('../app/controllers/' . $this->controllerName . '.php')) {
          echo 'Page not found.';
          exit();
        }
      }

      // Require contoller
      require_once '../app/controllers/' . $this->controllerName . '.php';

      // Creates controller
      $this->controller = new $this->controllerName;

      // If the parameter "method" exists
      if (isset($url[1])) {

        // Set method
        $this->method = $url[1];

        // If method doesn't exist inside controller
        if (!method_exists($this->controller, $this->method)) {
          $this->method = 'index';
        }

        unset($url[1]);
      }

      // Get params
      $this->params = $url ? array_values($url) : [];

      // Call controller with parameters
      $this->controller->{ $this->method }( $this->params );
    }

  }


// URL format: http://Financy/controller/method/params