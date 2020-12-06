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
        "title" => "Painel",
      ];
      
      $this->view('painel', $data);
    }

    public function logout() {
      unset($_SESSION['user_id']);
      unset($_SESSION['username']);
      unset($_SESSION['email']);

      header('Location:' . URLROOT . '/login');
    }

  }