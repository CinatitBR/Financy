<!DOCTYPE html>
<html lang="pt-BR">
<head>
  
  <?php require APPROOT . '/views/templates/head.php'; ?>

  <link rel="stylesheet" href="<?php echo URLROOT . '/public/css/painel.css' ?>">

  <script 
    type="module"
    src="<?php echo URLROOT . '/public/js/painel/index.js' ?>" 
    defer
  ></script>

  <script 
    src="<?php echo URLROOT . '/public/js/vendor/vanilla-masker.min.js' ?>"
    defer
  ></script>

</head>
<body>

  <header>
    <nav class="navbar navbar-expand-lg navbar-dark">
      <a class="navbar-brand" href="<?php echo URLROOT; ?>"><h1>Financy</h1></a>

      <button 
        class="navbar-toggler" 
        type="button" 
        data-toggle="collapse" 
        data-target="#navbarSupportedContent" 
        aria-controls="navbarSupportedContent" 
        aria-expanded="false" 
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav links mr-auto">

          <li class="nav-item active">
            <a 
              class="nav-link" 
              href="<?php echo URLROOT; ?>/painel"
            >
                Painel 
                <span class="sr-only">(current)</span>
            </a>
          </li>

        </ul>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown user-profile__wrapper">

            <a 
              class="nav-link user-profile__link" 
              id="navbarDropdown" 
              role="button" 
              data-toggle="dropdown" 
              aria-haspopup="true" 
              aria-expanded="false"
            >
              <img 
                class="user-profile__img" 
                src="<?php echo URLROOT ?>/public/images/user-profile.svg" 
                alt="perfil"
              >
              <h3 class="user-profile__username"><?php echo $_SESSION['username'] ?></h3>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?php echo URLROOT; ?>/painel/logout">Sair</a>
            </div>

          </li>
        </ul>

      </div>
    </nav>
  </header>

  <div class="wrapper">

    <div class="menu-list">
      
      <!-- Menu Balance -->
      <div class="menu-balance menu">

        <select id="accountSelect"></select>
        <span id="alertSelect">Você ainda não tem uma conta</span>

        <span class="menu-content">R$</span>
        <div class="menu-title"><h3>Seu saldo</h3></div>

      </div>

      <!-- Menu transaction -->
      <div class="menu-transaction menu">
        
        <div class="wrapper-content">

          <!-- Modal ganho -->
          <span
            class="menu-content plus-icon__wrapper" 
            data-toggle="modal" 
            data-target="#modalAddEarn"
          >
            <!-- Plus icon -->
            <svg class="icon plus-icon" height="30px" viewBox="0 0 469.33333 469.33333" width="30px" xmlns="http://www.w3.org/2000/svg">
              <g fill="#363A41">
                <path class="icon plus-icon" d="m437.332031 192h-405.332031c-17.664062 0-32 14.335938-32 32v21.332031c0 17.664063 14.335938 32 32 32h405.332031c17.664063 0 32-14.335937 32-32v-21.332031c0-17.664062-14.335937-32-32-32zm0 0"/>
                <path class="icon plus-icon" d="m192 32v405.332031c0 17.664063 14.335938 32 32 32h21.332031c17.664063 0 32-14.335937 32-32v-405.332031c0-17.664062-14.335937-32-32-32h-21.332031c-17.664062 0-32 14.335938-32 32zm0 0"/>
              </g>
            </svg>
          </span>

          <!-- Modal despesa -->
          <span 
            class="menu-content minus-icon__wrapper" 
            data-toggle="modal" 
            data-target="#modalAddExpense"
          >
            <!-- Minus icon -->
            <svg class="icon minus-icon" height="469pt" viewBox="0 -192 469.33333 469" width="469pt" fill="#363A41" xmlns="http://www.w3.org/2000/svg">
              <path d="m437.332031.167969h-405.332031c-17.664062 0-32 14.335937-32 32v21.332031c0 17.664062 14.335938 32 32 32h405.332031c17.664063 0 32-14.335938 32-32v-21.332031c0-17.664063-14.335937-32-32-32zm0 0"/>
            </svg>
          </span>

        </div>

        <div class="menu-title"><h3>Adicionar transação</h3></div>
      </div>

      <!-- Menu wallet -->
      <div class="menu-wallet menu">

        <span 
          class="menu-content wallet-icon__wrapper" 
          data-toggle="modal"
          data-target="#modalAddAccount"
        >
          <!-- Wallet icon -->
          <svg class="icon wallet-icon" fill="#363A41" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            width="890.5px" height="890.5px" viewBox="0 0 890.5 890.5" style="enable-background:new 0 0 890.5 890.5;" xml:space="preserve"
          >
            <g>
              <path d="M208.1,180.56l355-96.9l-18.8-38c-12.3-24.7-42.3-34.9-67-22.6l-317.8,157.5H208.1z"/>
              <path d="M673.3,86.46c-4.399,0-8.8,0.6-13.2,1.8l-83.399,22.8L322,180.56h289.1h126l-15.6-57.2
                C715.5,101.06,695.3,86.46,673.3,86.46z"/>
              <path d="M789.2,215.56h-11.4h-15.5h-15.5H628.5H193.8h-57h-48h-8.9H50.1c-15.8,0-29.9,7.3-39.1,18.8c-4.2,5.3-7.4,11.4-9.2,18.1
                c-1.1,4.2-1.8,8.6-1.8,13.1v6v57v494.1c0,27.601,22.4,50,50,50h739.1c27.601,0,50-22.399,50-50v-139.5H542.4
                c-46.9,0-85-38.1-85-85v-45.8v-15.5v-15.5v-34.4c0-23,9.199-43.899,24.1-59.199c13.2-13.601,30.9-22.801,50.7-25.101
                c3.3-0.399,6.7-0.6,10.1-0.6h255.2H813h15.5h10.6v-136.5C839.2,237.96,816.8,215.56,789.2,215.56z"/>
              <path d="M874.2,449.86c-5-4.6-10.9-8.1-17.5-10.4c-5.101-1.699-10.5-2.699-16.2-2.699h-1.3h-1h-15.5h-55.9H542.4
                c-27.601,0-50,22.399-50,50v24.899v15.5v15.5v55.4c0,27.6,22.399,50,50,50h296.8h1.3c5.7,0,11.1-1,16.2-2.7
                c6.6-2.2,12.5-5.8,17.5-10.4c10-9.1,16.3-22.3,16.3-36.899v-111.3C890.5,472.16,884.2,458.959,874.2,449.86z M646.8,552.36
                c0,13.8-11.2,25-25,25h-16.6c-13.8,0-25-11.2-25-25v-16.6c0-8,3.7-15.101,9.6-19.601c4.3-3.3,9.601-5.399,15.4-5.399h4.2H621.8
                c13.8,0,25,11.199,25,25V552.36L646.8,552.36z"/>
            </g>
          </svg>
        </span>

        <div class="menu-title"><h3>Adicionar conta</h3></div>

      </div>

    </div>

    <!-- Payment table -->
    <?php require APPROOT . '/views/painel/paymentTable.php' ?>
  </div>

  <!-- MODALS -->

  <!-- Adicionar ganho -->
  <?php require APPROOT . '/views/painel/modalAddEarn.php'; ?>

  <!-- Adicionar despesa -->
  <?php require APPROOT . '/views/painel/modalAddExpense.php'; ?>

  <!-- Adicionar conta -->
  <?php require APPROOT . '/views/painel/modalAddAccount.php' ?>

</body>
</html>

