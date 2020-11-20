<?php

  // Load the model and the view
  class Controller {

    public function model($model) {
      // Require model
      require_once '../app/models/' . $model . '.php';

      // Create model and return it 
      return new $model();
    }

    // Check whether view doesn't exist and require it
    public function view($view, $data = []) {
      if(!file_exists('../app/views/' . $view . '/' . $view . '.php')) {
        die("This view doesn't exist.");
      }

      require_once '../app/views/' . $view . '/' . $view . '.php';
    }

  }