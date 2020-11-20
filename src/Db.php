<?php

abstract class Db {
  private static $db;

  public static function getDb() {
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db_name = 'pais';

    // Create database connection
    self::$db = new mysqli($host, $username, $password, $db_name);

    return self::$db;
  }

}