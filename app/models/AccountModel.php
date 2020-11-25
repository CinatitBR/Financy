<?php 
  class AccountModel extends Database {

    public function addAccount($accountName, $value, $user_id) {
      $sql = "
        INSERT INTO account (account_name, balance, user_id)
        VALUES ('$accountName', $value, $user_id)
      ";
      
      // If the query is succesfull
      if ($this->query($sql)) {
        return true;
      }
      else {
        return false;
      }
    }

  }