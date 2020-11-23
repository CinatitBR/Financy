<!DOCTYPE html>
<html lang="en">
<head>

  <?php require APPROOT . '/views/templates/head.php' ?>
  
</head>
<body>

  <?php require APPROOT . '/views/templates/header.php' ?>

  <div class="wrapper">

    <form class="form" method="POST" action="<?php echo URLROOT; ?>/login">
      <div class="form-info__wrapper">
        <p class="form-info">
          Ainda não tem uma conta? <a href="<?php echo URLROOT; ?>/cadastro">Cadastrar</a>
        </p>
      </div>

      <h1 class="form-title">Login</h1>

      <div class="field-list">

        <div class="item">
          <label for="email">Digite seu email:</label>
          <input 
            type="email" 
            name="email"
            value="<?php echo $data['email']; ?>" 
            id="email" 
            maxlength="254" 
            required
          />

          <div class="invalid-feedback" style="display: block;">
            <?php echo $data['emailError']; ?>
          </div>
        </div>

        <div class="item">
          <label for="password">Digite sua senha:</label>
          <input 
            type="password" 
            name="password" 
            value="<?php echo $data['password']; ?>" 
            id="password" 
            maxlength="255" 
            minlength="6" 
            required 
          />

          <div class="invalid-feedback" style="display: block;">
            <?php echo $data['passwordError']; ?>
          </div>
        </div>

      </div>

      <button type="submit" class="form-button">Avançar</button>
    </form>
    
  </div>

</body>
</html>
