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

    <form class="form" method="POST" action="<?php echo URLROOT; ?>/addAccount" >
      <div class="form-info__wrapper">
        <p class="form-info">
          <a href="<?php echo URLROOT ?>/painel">Voltar ao painel</a>
        </p>
      </div>

      <h1 class="form-title"><?php echo $data["title"] ?></h1>

      <div class="field-list">

        <div class="item">
          <label for="inpt-accountName">Digite o nome da sua conta:</label>
          <input 
            type="text" 
            name="accountName" 
            id="inpt-accountName" 
            maxlength="100" 
            value="<?php echo $data['accountName']; ?>" 
            required 
          />

          <div class="invalid-feedback" style="display: block;">
            <?php echo $data["accountNameError"]; ?>
          </div>
        </div>

        <div class="item">
          <label for="inpt-value">Digite o valor inicial da sua conta:</label>
          <input 
            type="text" 
            class="money" 
            name="value"
            id="inpt-value"
            step="0.01"
            required
          >

          <div class="invalid-feedback" style="display: block;">
            <?php echo $data["valueError"]; ?>
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