<?php 
  function sessionAuthMiddleware($res) {
    session_start();
    if (isset($_SESSION['ID_USER'])) {
      $res->user = new stdClass();
      $res->user->ID_Usuario = $_SESSION['ID_USER'];
      $res->user->Usuario = $_SESSION['USER_NAME'];
      return;
    } else {
      header('Location: ' . BASE_URL . 'showLogin');
      die();
    }
  }