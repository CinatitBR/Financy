<?php

class CadastroModel {

  public static function teste() {
    // Get database connection
    $connection = Connection::getConnection();

    $sql = '
      SELECT nm_cidade
      FROM cidade
      WHERE cd_cidade = 1
    ';

    $res = $db->query($sql);
    $row = $res->fetch_assoc();
    var_dump($row);
  }
}