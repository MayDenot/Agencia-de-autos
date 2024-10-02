<?php 
  function sessionAuthMiddleware($res) {
    session_start();
    if (isset($_SESSION['ID_USER'])) {
      $res->user = new stdClass();
      $res->user->ID_Usuario = $_SESSION['ID_USER'];
      $res->user->Usuario = $_SESSION['USER_NAME'];
      return;
    }
  }