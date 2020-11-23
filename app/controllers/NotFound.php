<?php

  class NotFound extends Controller {
    public function index() {
      $data = [
        "title" => "Página não encontrada"
      ];
      
      $this->view('NotFound', $data);
    }
  }