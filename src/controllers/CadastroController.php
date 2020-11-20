<?php

class CadastroController extends Controller {

  public function index() {
    $this->loadTemplate('Cadastro');
  }

  public function register() {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // If the name is all white spaces
    if (ctype_space($name)) {
      $dados['errorMessage'] = 'Por favor, preencha todos os campos.';
      $this->loadTemplate('Cadastro', $dados);
    }
  }
}