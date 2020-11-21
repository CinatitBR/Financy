<!DOCTYPE html>
<html lang="en">
<head>

  <?php require APPROOT . '/views/templates/head.php' ?>
  
</head>
<body>

  <?php require APPROOT . '/views/templates/header.php' ?>

  <div class="wrapper">


    <form class="form" method="POST" action="<?php echo URLROOT; ?>/cadastro">
      <div class="form-info__wrapper">
        <p class="form-info">
          Já tem uma conta? <a href="<?php echo URLROOT ?>/login">Entrar</a>
        </p>
      </div>
    
      <h1 class="form-title">Cadastre-se.</h1>
    
      <div class="field-list">

        <div class="item">
          <label for="name">Como você gostaria de ser chamado?</label>
          <input type="text" name="username" maxlength="100" id="username" required />

          <div class="invalid-feedback">
            <?php echo $data['usernameError']; ?>
          </div>
        </div>
    
        <div class="item">
          <label for="email">Nos diga qual o seu melhor Email:</label>
          <input type="email" name="email" maxlength="254" id="email" required />

          <div class="invalid-feedback">
            <?php echo $data['emailError']; ?>
          </div>
        </div>
    
        <div class="item">
          <label for="password">Digite uma senha forte para sua conta:</label>
          <input type="password" name="password" id="password" maxlength="255" required />

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
