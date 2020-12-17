<?php 
  class PaymentModel extends Database {

    public function add($data) {
      extract($data);

      $sql = '';
      $result = '';

      // If the transaction has a "completed" status
      if ($status_id == 2) {
        $sql = "
          UPDATE account
          SET balance = balance + $value
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
        $lastPaymentId = $this->lastInsertedId();

        return $lastPaymentId;
      }
      else {
        return false;
      }
    }

    public function getPayments($user_id, $offset) {
      $sql = "
        SELECT payment_id, value, date, description, 
          account.account_name, category.category, status.status
        FROM payment
        LEFT JOIN account
          ON payment.account_id = account.account_id
        LEFT JOIN category
          ON payment.category_id = category.category_id
        LEFT JOIN status
          ON payment.status_id = status.status_id
        WHERE payment.user_id = $user_id
        ORDER BY payment_id DESC
        LIMIT 10
        OFFSET $offset
      ";

      $result = $this->query($sql);
      $payments = $this->resultSet($result);

      return $payments;
    }

    public function getPaymentsByLastId($user_id, $lastPaymentId) {
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
        WHERE payment.user_id = $user_id
        AND payment_id > $lastPaymentId
      ";

      $result = $this->query($sql);
      $payments = $this->resultSet($result);

      return $payments;
    }
  }