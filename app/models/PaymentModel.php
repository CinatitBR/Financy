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

      $sql = "
        INSERT INTO payment (value, description, user_id, account_id, category_id, status_id)
        VALUES ($value, $description, $user_id, $account_id, $category_id, $status_id);
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