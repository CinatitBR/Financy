<?php

class Core {
  public function start($url) {

    // Method to be executed
    $action = 'index';

    // Verify if "page" query string exists
    if (isset($url['page'])) {
      // Create controller name from the query string in the URL
      $controller_name = ucfirst($url['page'] . 'Controller');
    } 
    else {
      $controller_name = 'CadastroController';
    }

    // Verify whether controller exists
    if (!class_exists($controller_name)) {
      echo "Página não encontrada";
      return;
    }

    // Creates controller object
    $controller_obj = new $controller_name;

    // Executes $action method
    $controller_obj->{$action}();

  }
}