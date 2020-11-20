<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
      integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
      crossorigin="anonymous"
    />
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@1,700&family=Roboto:wght@400;500;700&display=swap"
      rel="stylesheet"
    />
    <!-- CSS -->
    <link rel="stylesheet" href="./global.css" />
    <!-- Bootstrap scripts -->
    <script
      src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
      defer
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
      crossorigin="anonymous"
      defer
    ></script>
    <title>Financy - Cadastro</title>
  </head>
  <body>

    <header class="container-fluid">
      <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand mx-auto" href="#"><h1>Financy</h1></a>
      </nav>
    </header>

    <div class="wrapper">
      
      <form method="POST" action="" class="form">
        <div class="form-info__wrapper">
          <p class="form-info">
            Já tem uma conta? <a href="#">Entrar</a>
          </p>
        </div>
      
        <h1 class="form-title">Cadastre-se.</h1>
      
        <div class="field-list">
          <div class="item">
            <label for="name">Como você gostaria de ser chamado?</label>
            <input type="text" name="name" maxlength="100" id="name" required />
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

  <script type="text/javascript">
    var field = document.querySelector('#name');

    field.addEventListener('keyup', (event) => {  
      var userName = field.value;
      userName = userName.replace(/\s/g, '');
      field.value = userName;
    });
  </script>
</html>
