<?php 
  function verifyAuthMiddleware($res) {
    if ($res->user) {
      return;
    } else {
      echo "<script>window.location=".BASE_URL."showLogin</script>";
      //header('Location: ' . BASE_URL . 'showLogin');
      die();
    }
  }