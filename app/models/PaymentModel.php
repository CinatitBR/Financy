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

    public function getPayments($user_id) {
      $sql = "
        SELECT value, date, description, 
          account.account_name, category.category, status.status
        FROM payment
        INNER JOIN account
          ON payment.account_id = account.account_id
        INNER JOIN category
          ON payment.category_id = category.category_id
        INNER JOIN status
          ON payment.status_id = status.status_id
        WHERE payment.user_id = $user_id;
      ";

      $result = $this->query($sql);
      $payments = $this->resultSet($result);

      return $payments;
    }
  }