<?php
  class Db {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $db_name = 'gestor_financeiro';

    protected function connect() {
      $db = new mysqli($host, $user, $password, $db_name);
      return $db;
    } 
  }
?>