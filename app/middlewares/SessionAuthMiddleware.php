<?php 
  function sessionAuthMiddleware($res) {
    session_start();
    if (isset($_SESSION['ID_Usuario'])) {
      $res->user = new stdClass();
      $res->user->ID_Usuario = $_SESSION['ID_Usuario'];
      $res->user->Usuario = $_SESSION['usuario'];
      return;
    } else {
      header('Location: ' . BASE_URL . 'showLogin');
      die();
    }
  }