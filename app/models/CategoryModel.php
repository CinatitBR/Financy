<?php 
  class CategoryModel extends Database {

    public function getCategories($user_id) {
      $sql = "
        SELECT category_id, category 
        FROM category
        WHERE user_id = $user_id
      ";

      $result = $this->query($sql);
      $result = $this->resultSet($result);

      return $result;
    }
  }