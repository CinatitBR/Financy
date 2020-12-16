<?php

  class Database {
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $dbName = 'gestor_teste';

    protected $conn;

    // Initialize database connection
    public function __construct() {
      $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbName);
      $this->conn->set_charset("utf8");

      if ($this->conn->connect_errno) {
        echo("Connection failed: :" . $mysqli->connect_error);
        exit();
      }
    }

    // Query database
    public function query($sql) {
      return $this->conn->query($sql);
    }

    // Fetch rows and return the result-set as an associative array
    public function resultSet($result) {
      return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Fetch a single row
    public function single($result) {
      return $result->fetch_assoc();
    }

    // Get last inserted ID
    public function lastInsertedId() {
      return $this->conn->insert_id;
    }
  }