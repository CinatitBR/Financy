<!DOCTYPE html>
<html lang="en">
  
  <?php require APPROOT . '/views/templates/head.php' ?>

  <body>

    <?php APPROOT . '/views/templates/header.php' ?>

    <div class="wrapper">

      <form class="form">
        <div class="form-info-wrapper">
          <p class="form-info">
            Ainda não tem uma conta? <a href="#">Cadastrar</a>
          </p>
        </div>
  
        <h1 class="form-title">Login</h1>
  
        <div class="field-list">
  
          <div class="item">
            <label for="email">Digite seu email:</label>
            <input type="email" id="email" maxlength="254" required />
          </div>
  
          <div class="item">
            <label for="password">Digite sua senha:</label>
            <input type="password" class="form-control" id="password" maxlength="255" required />
          </div>
  
        </div>
  
        <button type="submit" class="form-button">Avançar</button>
      </form>
      
    </div>

  </body>
</html>
