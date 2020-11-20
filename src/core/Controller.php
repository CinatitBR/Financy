<?php

class Controller {
  public $data;

  public function __construct() {
    $this->data = array();
  }

  public function loadTemplate($viewName, $modelData = array()) {
    $this->data = $modelData;

    // Call template.php
    require('./template.php');
  }

  public function loadViewIntoTemplate($viewName, $modelData = array()) {
    extract($modelData);
    $view = './src/views/' . $viewName . '/' . $viewName . '.php';

    // Call view
    require($view);
  }
}