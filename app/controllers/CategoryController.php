<?php
  class CategoryController extends Controller {
    private $categoryModel;

    public function __construct() {
      $this->categoryModel = $this->model('CategoryModel');
    }

    public function create() {
      $data = [
        'category' => '',
        'flow' => '',
        'user_id' => null,
      ];

      $feedbackErrors = [];

      $feedbackSuccess = [
        ['element' => 'success', 'message' => 'Categoria adicionada com sucesso!']
      ];

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Sanitize user data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data['category'] = trim($_POST['category']);
        $data['flow'] = trim($_POST['flow']);
        $data['user_id'] = $_SESSION["user_id"];

        // Replace multiple spaces with a single space
        $data['category'] = preg_replace("/\s+/", ' ', $data['category']);

        // Define characters that can be used in the category name
        $validation = "/^[\wÀ-ÿ\s]*$/";

        // Validate category name
        if (empty($data['category'])) {
          $feedbackErrors[] = [
            'element' => 'category-name-error', 
            'message' => 'Por favor, insira o nome da categoria que você quer adicionar.'
          ];
        }

        // Validate flow value
        $validateFlow = ['E', 'S'];

        if ( !in_array($data['flow'], $validateFlow) ) {
          $feedbackErrors[] = [
            'element' => 'category-flow-error', 
            'message' => 'O tipo da categoria não é válido. Por favor, tente novamente.'
          ];
        }

        // Validate characters
        if (!preg_match($validation, $data['category'])) {
          $feedbackErrors[] = [
            'element' => 'category-name-error', 
            'message' => 'O nome da categoria só pode conter letras, números, acentos, espaços e underlines.'
          ];
        }
        
        // If the category already exists
        $categoryExists = $this->categoryModel->findCategoryByName($data['category'], $data['user_id']);

        if ($categoryExists) {
          $feedbackErrors[] = [
            'element' => 'category-name-error', 
            'message' => 'Essa categoria já existe. Por favor, tente novamente.'
          ];
        }

        // If there are errors
        if ($feedbackErrors) {
          
          echo json_encode([
            'lastCategoryId' => null,
            'feedbacks' => $feedbackErrors
          ], JSON_UNESCAPED_UNICODE);

          return;
        }

        // Tries to insert category into database, and returns $lastCategoryId or false
        $lastCategoryId = $this->categoryModel->addCategory($data);

        // If the category was not added
        if (!$lastCategoryId) {
          $feedbackErrors[] = [
            'element' => 'database-error',
            'message' => "Erro ao adicionar categoria. Por favor, tente novamente."
          ];

          echo json_encode([
            'lastCategoryId' => null,
            'feedbacks' => $feedbackErrors
          ], JSON_UNESCAPED_UNICODE);

          return;
        }

        // If the category was added successfully
        echo json_encode([
          'lastCategoryId' => $lastCategoryId, 
          'feedbacks' => $feedbackSuccess
        ], JSON_UNESCAPED_UNICODE);

        return;
      }

    }

    public function getCategories($flow) {
      $user_id = $_SESSION['user_id'];
      $flow = $flow[0];
      
      $categories = $this->categoryModel->getCategories($flow, $user_id);

      echo json_encode($categories, JSON_UNESCAPED_UNICODE);
    }

  }