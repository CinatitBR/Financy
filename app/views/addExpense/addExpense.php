<!DOCTYPE html>
<html lang="en">
<head>
  
  <script src="<?php echo URLROOT; ?>/public/libraries/vanilla-masker.min.js"></script>
  <?php require APPROOT . '/views/templates/head.php' ?>

</head>
<body>

  <?php require APPROOT . '/views/templates/header.php' ?>
  
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
          <label for="accountOption">Conta</label>

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
          <label for="categoryOption">Categoria</label>

          <select name="category_id" id="categoryOption">
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
          <label for="inputValue">Valor</label>

          <input 
            type="text" 
            class="money" 
            name="value"
            aria-label="Amount (to the nearest dollar)" 
            step="0.01"
            id="inputValue"
            required
          >

          <div class="invalid-feedback" style="display: block;">
            <?php echo $data['valueError']; ?>
          </div>
        </div>

        <div class="item">
          <label for="statusOption">Status</label>

          <select name="status_id">
            <option value="2">Concluido</option>
            <option value="1">Pendente</option>
          </select>
        </div>

        <div class="item">
          <label for="description">Descricao (opcional)</label>

          <textarea name="description" id="description" rows="5"></textarea>
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