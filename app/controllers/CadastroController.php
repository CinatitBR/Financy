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

    public function register() {
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      $data = [
        'username' => $username,
        'email' => $email,
        'password' => $password
      ];

      $this->view('cadastro', $data);
    }
    
  }