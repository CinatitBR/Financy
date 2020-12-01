<!DOCTYPE html>
<html lang="en">
<head>
  
  <script src="<?php echo URLROOT; ?>/public/libraries/vanilla-masker.min.js"></script>
  <?php require APPROOT . '/views/templates/head.php' ?>

</head>
<body>
  
  <?php 
    if (!empty($data['success'])) {
      echo sprintf('
        <div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          %s
        </div>', 
        $data['success']
      );
    }
  ?>

  <div class="wrapper">

    <form class="form" method="POST" action="<?php echo URLROOT; ?>/addExpense" >
      <div class="form-info__wrapper">
        <p class="form-info">
          <a href="<?php echo URLROOT ?>/painel">Voltar ao painel</a>
        </p>
      </div>

      <h1 class="form-title"><?php echo $data["title"] ?></h1>

      <div class="field-list">

      <div class="item">
        <label for="accountOption">Selecione a conta relacionada:</label>

        <select name="account_id" id="accountOption">
          <?php 
            foreach ($data["accounts"] as $account) {
              echo sprintf(
                '<option value="%d">%s</option>', 
                $account['account_id'], $account['account_name']
              );
            }
          ?>
        </select>
      </div>

      <div class="item">
        <label for="categoryOption">Selecione a categoria da sua despesa:</label>

        <select name="category" id="categoryOption">
          <?php 
            foreach ($data["categories"] as $category) {
              echo sprintf(
                '<option value="%d">%s</option>', 
                $category['category_id'], $category['category']
              );
            }
          ?>
        </select>
      </div>

      <div class="item">
        <label for="inputValue">Digite o valor da sua despesa:</label>

        <input 
          type="text" 
          class="money" 
          aria-label="Amount (to the nearest dollar)" 
          step="0.01"
          id="inputValue"
          required
        >
      </div>

      </div>

      <button type="submit" class="form-button">Adicionar</button>
    </form>

  </div>

  <script>
    VMasker(document.querySelectorAll(".money")).maskMoney({
      precision: 2, 
      separator: ',',
      delimiter: '.',
      unit: 'R$',
    });
  </script>

</body>
</html>