<?php 
  class AddAccountController extends Controller {
    private $accountModel;

    public function __construct() {
      $this->accountModel = $this->model("accountModel");
    }

    public function index() {
      $data = [
        "title" => "Adicionar conta",
        "accountName" => "",
        "valueText" => "",
        "value" => 0,
        "success" => "",
        "accountNameError" => "",
        "valueError" => "",
        "errors" => []
      ];

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // Sanitize user data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $data['accountName'] = trim($_POST['accountName']);
        $data['valueText'] = trim($_POST['value']);
        $data['value'] = trim($_POST['value']);

        // Replace multiple spaces with a single space
        $data['accountName'] = preg_replace("/\s+/", ' ', $data['accountName']);

        // Define characters that can be used in the account name
        $validation = "/^[\wÀ-ÿ\s]*$/";

        // Validate account name
        if (empty($data['accountName'])) {
          $data["accountNameError"] = "Por favor, insira o nome da conta que você quer adicionar.";
        }
        elseif (!preg_match($validation, $data['accountName'])) {
          $data["accountNameError"] = "O nome da conta só pode conter letras, números, acentos, espaços e underlines.";
        }
        // If the account name already exists
        elseif ($this->accountModel->findAccountByName($data['accountName'])) {
          $data["accountNameError"] = "Essa conta já existe. Por favor, insira outro nome.";
        }

        // Gets account value
        $data["value"] = preg_replace("/[R$\s\.]/", '', $data['value']);
        $data["value"] = preg_replace("/[,]/", '.', $data['value']);
        // If the value is not numeric
        if (!is_numeric($data['value'])) {
          $data["valueError"] = "O valor inicial da conta não é valido. Por favor, tente novamente.";
        }

        // If there are no errors
        if ( empty($data["accountNameError"]) && empty($data["valueError"]) ) {
          // Converts string to number
          $data["value"] = $data["value"] + 0;

          // Gets user id
          $user_id = $_SESSION["user_id"];

          // Tries to insert account into database, and returns result
          $result = $this->accountModel->addAccount($data["accountName"], $data["value"], $user_id);

          // If the account was inserted successfully
          if ($result) {
            $data["success"] = "Conta adicionada com sucesso!";
          }
          else {
            exit("Erro ao adicionar conta ao banco de dados.");
          }
        }
      }

      $this->view('addAccount', $data);
    }

    public function getAccounts() {
      $user_id = $_SESSION['user_id'];

      $result = $this->accountModel->getAccounts($user_id);
      echo json_encode($result);
    }

  }