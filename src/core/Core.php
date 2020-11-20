<?php

class Core {
  public function start() {

    // If there is information in the URL
    if (isset($_GET['page']) && !empty($_GET['page'])) {
      $url = $_GET['page'];

      // Split the URL information
      $urlInfo = explode('/', $url);

      $controllerName = $urlInfo[0] . 'Controller';

      // If there is the method 
      if (isset($urlInfo[1]) && !empty($urlInfo[1])) {
        $controllerMethod = $urlInfo[1];
      }
      else { 
        $controllerMethod = 'index';
      }

      // If there is params
      if (isset($urlInfo[2]) && !empty($urlInfo[2])) {
        $params = $urlInfo[2];
      }
      
    }
    else {
      $controllerName = 'Cadastro';
      $controllerMethod = 'index';
    }

    // If controller doesn't exist
    if (!class_exists($controllerName)) {
      echo "Página não encontrada";
      return;
    }

    // Creates controller 
    $controller = new $controllerName;

    // Executes method
    $controller->{$controllerMethod}();

  }
}

// Url format: www.domain.com/controllerName/controllerMethod/params