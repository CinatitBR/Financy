<?php
  class CadastroController extends Controller {
    private $userModel;

    public function __construct() {
      $this->userModel = $this->model('UserModel');
    }

    public function index() {
      $users = $this->userModel->getUsers();

      $data = [
        'users' => $users
      ];

      $this->view('cadastro', $data);
    }
    
  }