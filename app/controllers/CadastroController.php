<?php

  class CadastroController extends Controller {
    private $userModel;

    public function __construct() {
      $this->userModel = $this->model('UserModel');
    }

    public function index() {
      $data = [
        "title" => "Cadastro",
      ];

      $this->view('cadastro', $data);
    }
    
  }