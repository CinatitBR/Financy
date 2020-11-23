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

  }