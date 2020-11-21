<!DOCTYPE html>
<html lang="en">
<head>

  <?php require APPROOT . '/views/templates/head.php' ?>
  
</head>
<body>

  <?php require APPROOT . '/views/templates/header.php' ?>

  <div class="wrapper">

    <form method="POST" action="<?php echo './cadastro/register' ?>" class="form">
      <div class="form-info__wrapper">
        <p class="form-info">
          Já tem uma conta? <a href="#">Entrar</a>
        </p>
      </div>
    
      <h1 class="form-title">Cadastre-se.</h1>
    
      <div class="field-list">
        <div class="item">
          <label for="name">Como você gostaria de ser chamado?</label>
          <input type="text" name="username" maxlength="100" id="name" required />
        </div>
    
        <div class="item">
          <label for="email">Nos diga qual o seu melhor Email:</label>
          <input type="email" name="email" maxlength="254" id="email" required />
        </div>
    
        <div class="item">
          <label for="password">Digite uma senha forte para sua conta:</label>
          <input type="password" name="password" class="form-control" id="password" maxlength="255" required />
        </div>
    
      <button type="submit" class="form-button">Avançar</button>
    </form>

  </div>

</body>
</html>
