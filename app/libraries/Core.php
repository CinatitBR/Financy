<?php
  class Core {
    protected $controllerName;
    protected $method = 'index';
    protected $params = [];
    
    protected $controller;

    function start() {
      $url = [];

      // If the URL parameter doesn't exist
      if (!isset($_GET['url'])) {
        header("Location:" . URLROOT . "/painel");
      }
      else {
        $url = explode('/', $_GET['url']);
      }

      // Verify whether the user is logged in, and redirects him to the right page
      if (isLoggedIn()) {
        if ($url[0] === "cadastro" || $url[0] === "login") {
          header("Location:" . URLROOT . '/painel');
        }
      }
      elseif ($url[0] === "painel") {
        header("Location:" . URLROOT . '/login');
      }

      // Get the controller name, converting first letter to uppercase
      $this->controllerName = ucwords($url[0]) . 'Controller';
      unset($url[0]);

      // If controller doesn't exist
      if(!file_exists('../app/controllers/' . $this->controllerName . '.php')) {
        // Call "NotFound" controller
        require_once '../app/controllers/NotFound.php';
        $this->controller = new NotFound;
        $this->controller->{ "index" }( $this->params );
        exit();
      }

      // Requires contoller
      require_once '../app/controllers/' . $this->controllerName . '.php';

      // Creates controller
      $this->controller = new $this->controllerName;

      // If the parameter "method" exists
      if (isset($url[1])) {

        // Set method
        $this->method = $url[1];

        // If method doesn't exist inside controller
        if (!method_exists($this->controller, $this->method)) {
          // Call "NotFound" controller
          require_once '../app/controllers/NotFound.php';
          $this->controller = new NotFound;
          $this->controller->{ "index" }( $this->params );
          exit();
        }

        unset($url[1]);
      }

      // Get params
      $this->params = $url ? array_values($url) : [];

      // Call the controller with params
      $this->controller->{ $this->method }( $this->params );
    }

  }


// URL format: http://Financy/controller/method/params
// $_GET['url']: controller/method/params