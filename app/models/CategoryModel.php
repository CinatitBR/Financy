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

    public function addCategory($data) {
      extract($data);

      $sql = "
        INSERT INTO category (category, flow, user_id)
        VALUES ('$category', '$flow', $user_id)
      ";

      $result = $this->query($sql);

      // If the query was succesfull, return last category's id
      if ($result) {
        $lastCategoryId = $this->lastInsertedId();

        return $lastCategoryId;
      }
      else {
        return false;
      }
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

    public function findCategoryByName($category, $user_id) {
      $sql = "
        SELECT * FROM category
        WHERE category = '$category'
        AND user_id = $user_id
      ";

      $result = $this->query($sql);

      // If the category already exists
      if ($result->num_rows > 0) {
        return true;
      }
      else {
        return false;
      }
    }
    
  }