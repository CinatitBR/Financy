<?php

$cadastro_page = file_get_contents('./src/views/Cadastro/cadastro.html');

class CadastroController {

  public function index() {
    CadastroModel::teste();
    // echo $cadastro_page;
  }
}