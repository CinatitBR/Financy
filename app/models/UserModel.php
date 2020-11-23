<?php

  class UserModel extends Database {
    
    // Find user by email. Email is passed by the controller
    public function findUserByEmail($email) {
      $sql = "
        SELECT * FROM user
        WHERE email = '$email'
      ";

      $result = $this->query($sql);

      // If the email is already taken
      if($result->num_rows > 0) { 
        return true;
      }
      else {
        return false;
      };
    }

    // Register user
    public function register($username, $email, $password) {

      $sql = "
        INSERT INTO user (username, email, password, created_at)
        VALUES ('$username', '$email', '$password', NOW())
      ";

      $result = $this->query($sql);

      // If the query was successful
      if($result) {
        return true;
      }
      else {
        return false;
      }
    }

    // Login user
    public function login($email, $password) {
      $sql = "
        SELECT * FROM user
        WHERE email = '$email'
      ";

      $result = $this->query($sql);
      $user_row = $this->single($result);

      $hashedPassword = $user_row['password'];

      // Verify password
      if (password_verify($password, $hashedPassword)) {
        return $user_row;
      }
      else {
        return false;
      }
    }

  }