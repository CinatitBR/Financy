<?php

  class CadastroController extends Controller {
    private $userModel;

    public function __construct() {
      $this->userModel = $this->model('UserModel');
    }

    public function index() {
      $data = [
        'title' => 'Cadastro',
        'username' => '',
        'email' => '',
        'password' => '',
        'usernameError' => '',
        'emailError' => ''
      ];

      // Checks whether server has received a POST request 
      if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitize user data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data['username'] = trim($_POST['username']);
        $data['email'] = trim($_POST['email']);
        $data['password'] = trim($_POST['password']); 

        $data['username'] = preg_replace("/\s+/", ' ', $data['username']); // Replace multiple spaces with a single space

        // Define characters that can be used in the username
        $nameValidation = "/^[\wÀ-ÿ\s]*$/";

        // Validate username
        if(empty($data['username'])) {
          $data['usernameError'] = "Por favor, digite o nome que você quer ser chamado.";
        } 
        elseif(!preg_match($nameValidation, $data['username'])) {
          $data['usernameError'] = "O nome só pode conter letras, números, acentos e espaços.";
        }

        // Validate email
        if(empty($data['email'])) {
          $data['emailError'] = "Por favor, digite seu email.";
        } 
        elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) { // If the email doesn't have the correct format
          $data['emailError'] = "Por favor, digite o email corretamente.";
        }
        else { // Verify is the email is already taken
          if($this->userModel->findUserByEmail($data['email'])) {
            $data['emailError'] = "Este email já está cadastrado. Por favor, insira outro email ou entre em sua conta.";
          }
        }

        // Verify if there are no erros
        if( empty($data['usernameError']) && empty($data['emailError']) ) {

          // Hash the password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register user using model function
          if($this->userModel->register($data)) {
            // Redirect to login page
            header('Location: ' . URLROOT . '/login');
          } 
          else {
            die('Não foi possível registrar o usuário, algo deu errado.');
          }
        }

      }

      $this->view('cadastro', $data);
    }
    
  }