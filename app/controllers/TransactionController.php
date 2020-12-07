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
        "user_id" => 0,

        "valueError" => "",

        "success" => "Pagamento adicionado com sucesso!",
        "databaseError" => "Erro ao adicionar pagamento. Por favor, tente novamente."
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
          $data['valueError'] = "Este valor não é válido. Por favor, tente novamente.";
        }

        // If there are no errors
        if (empty($data['valueError'])) {
          $message = ['success' => $data['success']];

          // Add payment to database
          $result = $this->paymentModel->add($data);

          // If the payment was added successfully
          if ($result) {
            echo json_encode($message, JSON_UNESCAPED_UNICODE);
          } 
          else {
            $message = ['databaseError' => $data['databaseError']];
            echo json_encode($message, JSON_UNESCAPED_UNICODE);
          }
        } 
        else {
          $message = ['valueError' => $data['valueError']];

          echo json_encode($message, JSON_UNESCAPED_UNICODE);
        }
      }
    }

  }
