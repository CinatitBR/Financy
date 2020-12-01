<?php 
  class AddExpenseController extends Controller {
    private $accountModel;

    public function __construct() {
      $this->accountModel = $this->model("AccountModel");
    }

    public function index() {
      $data = [
        "title" => "Adicionar despesa",
        "accounts" => []
      ];

      $data["accounts"] = $this->accountModel->getAccounts($_SESSION['user_id']);

      $this->view("addExpense", $data);
    }

  }