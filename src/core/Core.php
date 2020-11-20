<?php
require('./src/controllers/Home.php');

class Core {
  public function start($get_url) {
    // Get controller name from the query string in the URL
    $controller_name = ucfirst($get_url['page'] . 'Controller');
    $action = 'index';

    // Verify whether controller exists
    if (!class_exists($controller)) {
      echo "Página não encontrada";
      return;
    }

    // Creates controller object
    $controller_obj = new $controller;

    // Executes $action method
    $controller_ob->{$action}();

    // call_user_func_array(array(new $controller, $acao))

  }
}