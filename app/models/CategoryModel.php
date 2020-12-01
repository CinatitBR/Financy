<?php 
  class CategoryModel extends Database {

    public function getCategories($flow, $user_id) {
      $sql = "
        SELECT category_id, category 
        FROM category
        WHERE user_id = $user_id
        AND flow = '$flow'
      ";

      $result = $this->query($sql);
      $result = $this->resultSet($result);

      return $result;
    }
  }