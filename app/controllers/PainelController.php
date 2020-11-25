<?php

  class PainelController extends Controller {
    private $userModel;

    public function __construct() {
      $this->userModel = $this->model('UserModel');
    }

    public function index() {
      $data = [
        "title" => "Painel"
      ];

      $this->view('painel', $data);
    }

    public function logout() {
      unset($_SESSION['user_id']);
      unset($_SESSION['username']);
      unset($_SESSION['email']);

      header('Location:' . URLROOT . '/login');
    }
    
    public function addAccount() {
      $data = [
        "accountName" => "",
        "value" => 0,
        "accountNameError" => "",
        "valueError" => ""
      ];

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitize user data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data['accountName'] = trim($_POST['accountName']);
        $data['value'] = trim($_POST['value']);

        // Replace multiple spaces with a single space
        $data['accountName'] = preg_replace("/\s+/", ' ', $data['accountName']);

        // Validate account name

      }
      else {
        echo "Ha";
        return;
      }

    }

  }