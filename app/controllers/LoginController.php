<?php 

  class LoginController extends Controller {
    private $userModel;

    public function __construct() {
      $this->userModel = $this->model('UserModel');
    }

    public function index() {
      $data = [
        "title" => "Login"
      ];

      $this->view('login', $data);
    }
  }