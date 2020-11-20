
<form method="POST" action="Cadastro/register" class="form">
  <div class="form-info__wrapper">
    <p class="form-info">
      Já tem uma conta? <a href="#">Entrar</a>
    </p>
  </div>

  <h1 class="form-title">Cadastre-se.</h1>

  <div class="field-list">
    <div class="item">
      <label for="name">Como você gostaria de ser chamado?</label>
      <input type="text" name="name" maxlength="100" required />
    </div>

    <div class="item">
      <label for="email">Nos diga qual o seu melhor Email:</label>
      <input type="email" name="email" maxlength="254" required />
    </div>

    <div class="item">
      <label for="password">Digite uma senha forte para sua conta:</label>
      <input type="password" name="password" class="form-control" maxlength="255" required />
    </div>

    <div class="item error">
      <?php
        if (isset($errorMessage)) {
          echo $errorMessage;
        }
      ?>
    </div>
  </div>

  <button type="submit" class="form-button">Avançar</button>
</form>