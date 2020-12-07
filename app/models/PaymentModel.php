<?php 
  class PaymentModel extends Database {

    public function add($data) {
      extract($data);

      $sql = "";
      $result = "";

      // If the transaction has a "completed" status
      if ($status_id == 2) {
        $signal = $flow === "E" ? "+" : "-";

        $sql = "
          UPDATE account
          SET balance = balance $signal $value
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