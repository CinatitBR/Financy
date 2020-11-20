<?php

$cadastro_page = file_get_contents('./src/views/Cadastro/cadastro.html');

class CadastroController extends Controller {

  public function index() {
    $this->loadTemplate('Cadastro');
  }
}