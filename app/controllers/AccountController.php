<?php 
  class AccountController extends Controller {
    private $accountModel;

    public function __construct() {
      $this->accountModel = $this->model("accountModel");
    }

    public function create() {
      $data = [
        "account_name" => "",
        "value" => 0,
        "user_id" => 0
      ];

      $feedbackErrors = [];

      $feedbackSuccess = [
        ['element' => 'success', 'message' => 'Conta adicionada com sucesso!']
      ];

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitize user data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        $data['account_name'] = trim($_POST['account_name']);
        $data['value'] = trim($_POST['value']);
        $data['user_id'] = $_SESSION["user_id"];

        // Replace multiple spaces with a single space
        $data['account_name'] = preg_replace("/\s+/", ' ', $data['account_name']);

        // Define characters that can be used in the account name
        $validation = "/^[\wÀ-ÿ\s]*$/";

        // Validate account name
        if (empty($data['account_name'])) {
          $feedbackErrors[] = [
            'element' => 'account_nameError', 
            'message' => 'Por favor, insira o nome da conta que você quer adicionar.'
          ];
          // $data["account_nameError"] = "Por favor, insira o nome da conta que você quer adicionar.";
        }
        elseif (!preg_match($validation, $data['account_name'])) {
          $feedbackErrors[] = [
            'element' => 'account_nameError', 
            'message' => 'O nome da conta só pode conter letras, números, acentos, espaços e underlines.'
          ];
        }
        // If the account name already exists
        elseif ($this->accountModel->findAccountByName($data['account_name'])) {
          $feedbackErrors[] = [
            'element' => 'account_nameError', 
            'message' => 'Essa conta já existe. Por favor, insira outro nome.'
          ];
        }

        // Gets account value
        $data["value"] = preg_replace("/[R$\s\.]/", '', $data['value']);
        $data["value"] = preg_replace("/[,]/", '.', $data['value']);

        // If the value is not numeric
        if (!is_numeric($data['value'])) {
          $feedbackErrors[] = [
            'element' => 'valueError', 
            'message' => 'O valor inicial da conta não é valido. Por favor, tente novamente.'
          ];
        }

        // If there are errors
        if ($feedbackErrors) {
          echo json_encode($feedbackErrors, JSON_UNESCAPED_UNICODE);
          return;
        }

        // Converts string to number
        $data["value"] = $data["value"] + 0;

        // Tries to insert account into database, and returns result
        $result = $this->accountModel->addAccount($data);

        // If the account was not added
        if (!$result) {
          $feedbackErrors[] = [
            'element' => 'databaseError',
            'message' => "Erro ao adicionar pagamento. Por favor, tente novamente."
          ];

          echo json_encode($feedbackErrors, JSON_UNESCAPED_UNICODE);
          return;
        }

        // If the account was added successfully
        echo json_encode($feedbackSuccess, JSON_UNESCAPED_UNICODE);
        return;
      }
    }

    public function getAccounts() {
      $user_id = $_SESSION['user_id'];

      $accounts = $this->accountModel->getAccounts($user_id);
      echo json_encode($accounts, JSON_UNESCAPED_UNICODE);
    }

    public function getAccountsByLastId($params) {
      $user_id = $_SESSION['user_id'];
      $lastAccountId = $params[0];

      $accounts = $this->accountModel->getAccountsByLastId($user_id, $lastAccountId);
      
      echo json_encode($accounts, JSON_UNESCAPED_UNICODE);
    }

  }