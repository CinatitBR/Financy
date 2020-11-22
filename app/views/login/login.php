<!DOCTYPE html>
<html lang="en">
<head>

  <?php require APPROOT . '/views/templates/head.php' ?>
  
</head>
<body>

  <?php require APPROOT . '/views/templates/header.php' ?>

  <div class="wrapper">

    <form class="form">
      <div class="form-info__wrapper">
        <p class="form-info">
          Ainda não tem uma conta? <a href="<?php echo URLROOT ?>/cadastro">Cadastrar</a>
        </p>
      </div>

      <h1 class="form-title">Login</h1>

      <div class="field-list">

        <div class="item">
          <label for="email">Digite seu email:</label>
          <input type="email" name="email" id="email" maxlength="254" required />

          <div class="invalid-feedback">
            <?php echo $data['emailError']; ?>
          </div>
        </div>

        <div class="item">
          <label for="password">Digite sua senha:</label>
          <input type="password" name="password" id="password" maxlength="255" minlength="6" required />

          <div class="invalid-feedback">
            <?php echo $data['passwordError']; ?>
          </div>
        </div>

      </div>

      <button type="submit" class="form-button">Avançar</button>
    </form>
    
  </div>

</body>
</html>
