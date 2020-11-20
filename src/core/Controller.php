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
    $viewPath = './src/views/' . $viewName . '/' . $viewName . '.html';

    // Call view
    require($viewPath);
  }
}