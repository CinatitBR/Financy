<?php
  session_start();

  function isLoggedIn() {

    // If the session exists
    if (isset($_SESSION['user_id'])) {
      return true;
    }
    else {
      return false;
    }
    
  }