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

  }