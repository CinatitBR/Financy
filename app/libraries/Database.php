<?php

  class Database {
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $dbName = 'gestor_financeiro';

    protected $conn;

    // Initialize database connection
    public function __construct() {
      $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbName);

      if($this->conn->connect_errno) {
        echo("Connection failed: :" . $mysqli->connect_error);
        exit();
      }
    }

    public function query($sql) {
      return $this->conn->query($sql);
    }

    // Fetch rows and return the result-set as an associative array
    public function resultSet($result) {
      return $result->fetch_all(MYSQLI_ASSOC);
    }
  }