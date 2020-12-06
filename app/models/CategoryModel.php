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

    public function addCategories($categories, $user_id) {
      foreach ($categories as $category) {
        $category_name = $category['category'];
        $flow = $category['flow'];

        $sql = "
          INSERT INTO category (category, flow, user_id)
          VALUES ('$category_name', '$flow', $user_id)
        ";

        $result = $this->query($sql);

        if (!$result) {
          return false;
        }
      }
      return true;
    }
    
  }