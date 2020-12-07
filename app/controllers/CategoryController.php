<?php
  class CategoryController extends Controller {
    private $categoryModel;

    public function __construct() {
      $this->categoryModel = $this->model('CategoryModel');
    }

    public function getCategories($flow) {
      $user_id = $_SESSION['user_id'];
      $flow = $flow[0];
      
      $categories = $this->categoryModel->getCategories($flow, $user_id);

      echo json_encode($categories, JSON_UNESCAPED_UNICODE);
    }

  }