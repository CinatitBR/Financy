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
          <option value="1">Conta 1</option>
          <option value="2">Conta 2</option>
          <option value="3">Conta 3</option>
        </select>
      </div>

      <div class="item">
        <label for="categoriaOption">Selecione a categoria da sua despesa:</label>

        <select name="categoria" class="form-control" id="categoriaOption">
          <option value="Comida">Comida</option>
          <option value="Educação">Educação</option>
          <option value="Veículo">Veículo</option>
        </select>
      </div>

      <div class="item">
        <label for="inputValor">Digite o valor da sua despesa:</label>

        <div class="input-group">
          <input 
            type="text" 
            class="form-control money" 
            aria-label="Amount (to the nearest dollar)" 
            step="0.01"
            id="inputValor"
            style="width: initial;"
            required
          >
        </div>
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