<?php

class Connection {
  private static $connection;

  public static function getConnection() {

    // Check if $connection doesn't exists
    if(!isset(self::$connection)) {
      $host = 'localhost';
      $username = 'root';
      $password = '';
      $db_name = 'pais';
  
      // Create database connection
      self::$connection = new mysqli($host, $username, $password, $db_name);
    }

    return self::$connection;
  }

}