<?php

class Core {
  public function start($url) {

    // Method to be executed
    $method = 'index';

    // Verify if "page" query string exists
    if (isset($url['page'])) {
      // Create controller name from the query string 
      $controller_name = ucfirst($url['page'] . 'Controller');
    } 
    else {
      $controller_name = 'CadastroController';
    }

    // Verify if controller doesn't exist
    if (!class_exists($controller_name)) {
      echo "Página não encontrada";
      return;
    }

    // Creates controller object
    $controller_obj = new $controller_name;

    // Executes method
    $controller_obj->{$method}();

  }
}