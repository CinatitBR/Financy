<?php 
  class AddExpenseController extends Controller {
    private $accountModel;
    private $categoryModel;

    public function __construct() {
      $this->accountModel = $this->model("AccountModel");
      $this->categoryModel = $this->model("CategoryModel");
    }

    public function index() {
      $data = [
        "title" => "Adicionar despesa",
        "accounts" => [],
        "categories" => []
      ];

      $user_id = $_SESSION['user_id'];

      $data["accounts"] = $this->accountModel->getAccounts($user_id);
      $data["categories"] = $this->categoryModel->getCategories($user_id);

      $this->view("addExpense", $data);
    }

  }