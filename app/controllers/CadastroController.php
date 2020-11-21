<?php

  class CadastroController extends Controller {
    private $userModel;

    public function __construct() {
      $this->userModel = $this->model('UserModel');
    }

    public function index() {
      $data = [
        "title" => "Cadastro",
        "usernameError" => "Por favor, preencha corretamente.",
        "emailError" => "Erro email",
        "passwordError" => "Erro senha" 
      ];

      $this->view('cadastro', $data);
    }
    
  }