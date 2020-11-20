<?php

class UserModel {

  private $connection;

  function __construct() {
    // Get database connection
    $this->connection = Connection::getConnection();
  }

  public static function teste() {
    $sql = '
      SELECT nm_cidade
      FROM cidade
      WHERE cd_cidade = 1
    ';

    $res = $connection->query($sql);
    $row = $res->fetch_assoc();
    var_dump($row);
  }
}