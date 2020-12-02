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

    public function findAccountByName($accountName) {
      $sql = "
        SELECT * FROM account
        WHERE account_name = '$accountName';
      ";

      $result = $this->query($sql);

      // If the account name already exists
      if ($result->num_rows > 0) {
        return true;
      }
      else {
        return false;
      }
    }

    public function getAccounts($user_id) {
      $sql = "
        SELECT account_id, account_name, balance
        FROM account
        WHERE user_id = $user_id;
      ";

      $result = $this->query($sql);
      $result = $this->resultSet($result);

      return $result;
    }

  }