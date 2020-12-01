<?php 
  class AddExpenseController extends Controller {
    private $accountModel;
    private $categoryModel;
    private $paymentModel;

    public function __construct() {
      $this->accountModel = $this->model("AccountModel");
      $this->categoryModel = $this->model("CategoryModel");
      $this->paymentModel = $this->model("PaymentModel");
    }

    public function index() {
      $data = [
        "title" => "Adicionar despesa",
        "accounts" => [],
        "categories" => [],
        "accountId" => 0,
        "categoryId" => 0,
        "value" => 0,
        "status" => "",
        "valueError" => ""
      ];

      $user_id = $_SESSION['user_id'];
      $data["accounts"] = $this->accountModel->getAccounts($user_id);
      $data["categories"] = $this->categoryModel->getCategories("S", $user_id);

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $data['account_id'] = $_POST['account_id'];
        $data['category_id'] = $_POST['category_id'];
        $data['value'] = $_POST['value'];
        $data['status_id'] = $_POST['status_id'];
        $data['description'] = trim($_POST['description']);

        // Validates value
        $data["value"] = preg_replace("/[R$\s\.]/", '', $data['value']);
        $data["value"] = preg_replace("/[,]/", '.', $data['value']);
        // If the value is not numeric
        if (!is_numeric($data['value'])) {
          $data["valueError"] = "Este valor não é válido. Por favor, tente novamente.";
        }

        // If there are no errors
        if (empty($data['valueError'])) {
          // Converts string to number
          $data["value"] = $data["value"] + 0;

          $user_id = $_SESSION['user_id'];

          $result = $this->paymentModel->addExpense(
            $data['value'], 
            $data['description'], 
            $user_id, 
            $data['account_id'], 
            $data['category_id'], 
            $data['status_id']
          );

          if ($result) {
            $data['success'] = "Despesa adicionada com sucesso!";
          } 
          else {
            exit("Erro ao adicionar pagamento ao banco de dados.");
          }
        }
      }

      $this->view("addExpense", $data);
    }

  }