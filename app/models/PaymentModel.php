<?php 
  class PaymentModel extends Database {

    public function addExpense(
      $value, 
      $description, 
      $user_id, 
      $account_id, 
      $category_id, 
      $status_id
    ) {

      $sql = "";
      $result = "";

      // If the transaction is completed
      if ($status_id == 2) {

        $sql = "
          UPDATE account
          SET balance = balance - $value
          WHERE account_id = $account_id
        ";

        $result = $this->query($sql);

        // If the query was not successfull
        if (!$result) {
          return false;
        }
      }

      $sql = "
        INSERT INTO payment (value, description, user_id, account_id, category_id, status_id)
        VALUES ($value, '$description', $user_id, $account_id, $category_id, $status_id);
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
  }