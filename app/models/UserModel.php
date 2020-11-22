<?php

  class UserModel extends Database {
    
    // Find user by email. Email is passed by the controller
    public function findUserByEmail($email) {
      $sql = "
        SELECT * FROM user
        WHERE email = '$email'
      ";

      $result = $this->query($sql);

      // If the email is not already taken
      if($result->num_rows > 0) { 
        return true;
      }
      else {
        return false;
      };
    }

    // Register user
    public function register($data) {
      extract($data);

      $sql = "
        INSERT INTO user (username, email, password, created_at)
        VALUES ('$username', '$email', '$password', NOW())
      ";

      // If the query was successful
      if($this->query($sql)) {
        return true;
      }
      else {
        return false;
      }
    }

  }