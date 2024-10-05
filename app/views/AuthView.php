<?php 
  require_once "./app/controllers/AuthController.php";

  class AuthView {
    private $user = null;

    public function showLogIn($error = '') {
      require_once "./templates/layouts/formLogIn.phtml";
    }

    public function showErrorNotFound() {
      require_once "./templates/error404.phtml";
  }
  }