<?php
  class TransactionController extends Controller {
    private $paymentModel;

    public function __construct() {
      $this->paymentModel = $this->model('PaymentModel');
    }

    public function create() {
      $data = [
        "account_id" => 0,
        "category_id" => 0,
        "status_id" => 0,
        "value" => 0,
        "description" => "",
        "flow" => "",
        "user_id" => 0
      ];

      $feedbackErrors = [];

      $feedbackSuccess = [
        ['element' => 'success', 'message' => 'Transação adicionada com sucesso!']
      ];

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data['account_id'] = $_POST['account_id'];
        $data['category_id'] = $_POST['category_id'];
        $data['status_id'] = $_POST['status_id'];
        $data['value'] = $_POST['value'];
        $data['description'] = $_POST['description'];
        $data['flow'] = $_POST['flow'];

        $data['user_id'] = $_SESSION['user_id'];

        // Validates value
        $data['value'] = preg_replace("/[R$\s\.]/", '', $data['value']);
        $data['value'] = preg_replace("/[,]/", '.', $data['value']);

        // If the value is not numeric
        if (!is_numeric($data['value'])) {
          $feedbackErrors[] = [
            'element' => 'valueError', 
            'message' => 'Este valor não é válido. Por favor, tente novamente.'
          ];
        }

        // If there are no errors
        if (empty($feedbackErrors)) {

          // Add payment to database
          $result = $this->paymentModel->add($data);

          // If the payment was not added
          if (!$result) {
            $feedbackErrors[] = [
              'element' => 'databaseError',
              'message' => "Erro ao adicionar pagamento. Por favor, tente novamente."
            ];

            echo json_encode($feedbackErrors, JSON_UNESCAPED_UNICODE);
            return;
          }

          // If the payment was added successfully
          echo json_encode($feedbackSuccess, JSON_UNESCAPED_UNICODE);
          return;
        } 
        else {
          echo json_encode($feedbackErrors, JSON_UNESCAPED_UNICODE);
        }
      }
    }

  }
