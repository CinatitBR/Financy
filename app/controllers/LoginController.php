<?php 

  class LoginController extends Controller {
    private $userModel;

    public function __construct() {
      $this->userModel = $this->model('UserModel');
    }

    public function index() {
      $data = [
        "title" => "Login",
        "email" => "",
        "password" => "",
        "emailError" => "",
        "passwordError" => ""
      ];

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitize user data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data['email'] = trim($_POST['email']);
        $data['password'] = trim($_POST['password']);

        // If the email is not registered
        if (!$this->userModel->findUserByEmail($data['email'])) {
          $data['emailError'] = "Este email ainda não foi cadastrado. Por favor, cadastre-se antes de logar.";
        }
  
        // Validate credentials
        if (empty($data['emailError'])) {
          $loggedInUser = $this->userModel->login($data['email'], $data['password']);

          // If the credentials are correct
          if ($loggedInUser) {
            $this->createUserSession($loggedInUser);
          } 
          else {
            $data['passwordError'] = "A senha para este email está incorreta. Por favor, tente novamente.";
          }
        }
      }

      $this->view('login', $data);
    }

    public function createUserSession($user) {
      $_SESSION['user_id'] = $user['user_id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['email'] = $user['email'];

      header('Location:' . URLROOT . '/painel');
    }
  }