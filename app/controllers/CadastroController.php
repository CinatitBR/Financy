<?php

  class CadastroController extends Controller {
    private $userModel;
    private $categoryModel;
    private $accountModel;

    public function __construct() {
      $this->userModel = $this->model('UserModel');
      $this->categoryModel = $this->model('CategoryModel');
      $this->accountModel = $this->model('AccountModel');
    }

    public function index() {
      $data = [
        'title' => 'Cadastro',
        'username' => '',
        'email' => '',
        'password' => '',
        'usernameError' => '',
        'emailError' => '',
        'defaultCategories' => [
          ['category' => 'Salário', 'flow' => 'E'],
          ['category' => 'Educação', 'flow' => 'S']
        ],
        'defaultAccounts' => [
          ['account' => 'Cartão de crédito', 'balance' => 00.00],
          ['account' => 'Conta corrente', 'balance' => 00.00]
        ]
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
        elseif (!preg_match($nameValidation, $data['username'])) {
          $data['usernameError'] = "O nome só pode conter letras, números, acentos, espaços e underlines.";
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

          // Register user and get user_id
          $user_id = $this->userModel->register($data['username'], $data['email'], $data['password']);

          // If the user was not registered
          if (!$user_id) {
            die('Não foi possível registrar o usuário, algo deu errado.');
          } 
          
          // Insert default categories and accounts
          $resultCategories = $this->categoryModel->addCategories($data['defaultCategories'], $user_id);
          $resultAccounts = $this->accountModel->addAccounts($data['defaultAccounts'], $user_id);

          if ($resultCategories && $resultAccounts) {
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