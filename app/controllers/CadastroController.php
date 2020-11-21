<?php

  class CadastroController extends Controller {
    private $userModel;

    public function __construct() {
      $this->userModel = $this->model('UserModel');
    }

    public function index() {
      $data = [
        "title" => "Cadastro",
        "username" => "",
        "email" => "",
        "password" => "",
        "usernameError" => "",
        "emailError" => "",
        "passwordError" => "",
      ];

      // Checks whether server has received a POST request 
      if($_SERVER['REQUEST_METHOD'] === 'POST') {

      }

      $this->view('cadastro', $data);
    }
    
  }