<?php

  class UserModel extends Database {
    
    public function getUsers() {
      $sql = "
        SELECT * FROM usuario
      ";

      $result = $this->query($sql);

      return $this->resultSet($result);
    }

  }