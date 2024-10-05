<?php 
  function sessionAuthMiddleware($res) {
    if (!isset($_SESSION)) {
      session_start();
    }
    if (isset($_SESSION['ID_USER'])) {
      $res->user = new stdClass();
      $res->user->ID_Usuario = $_SESSION['ID_USER'];
      $res->user->Usuario = $_SESSION['USER_NAME'];
      return;
    }
  }
?>