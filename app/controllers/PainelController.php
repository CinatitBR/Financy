<?php

  class PainelController extends Controller {
    private $userModel;
    private $accountModel;

    public function __construct() {
      $this->userModel = $this->model('UserModel');
      $this->accountModel = $this->model('AccountModel');
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
        "title" => "Painel",
        "accountName" => "",
        "value" => 0,
        "success" => "Conta adicionada com sucesso!",
        "errors" => []
      ];

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitize user data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data['accountName'] = trim($_POST['accountName']);
        $data['value'] = trim($_POST['value']);

        // Replace multiple spaces with a single space
        $data['accountName'] = preg_replace("/\s+/", ' ', $data['accountName']);

        // Define characters that can be used in the account name
        $accountValidation = "/^[\wÀ-ÿ\s]*$/";

        // Validate account name
        if (empty($data['accountName'])) {
          $data["errors"][] = "Por favor, insira o nome da conta que você quer adicionar.";
        }
        elseif (!preg_match($accountValidation, $data['accountName'])) {
          $data["errors"][] = "O nome da conta só pode conter letras, números, acentos, espaços e underlines.";
        }

        // Gets account value
        $data['value'] = preg_replace("/[R$\s\.]/", '', $data['value']);
        $data['value'] = preg_replace("/[,]/", '.', $data['value']);
        // If the value is not numeric
        if (!is_numeric($data['value'])) {
          $data['errors'][] = "O valor inicial da conta não é valido. Por favor, tente novamente.";
        }

        // If there are no errors
        if (empty($data['errors'])) {
          // Converts string to number
          $data['value'] = $data['value'] + 0;

          // Gets user id
          $user_id = $_SESSION['user_id'];

          // Tries to insert account into database, and returns result
          $result = $this->accountModel->addAccount($data['accountName'], $data['value'], $user_id);

          // If the account was inserted
          if ($result) {
            header("Location:" . URLROOT . "/painel");
          }
          else {
            exit("Erro ao adicionar conta ao banco de dados.");
          }
        }

        $this->view('painel', $data);
      }

    }

  }