<?php 
  require_once "./app/controllers/AuthController.php";

  class AuthView {
    protected $user = null;

    public function showLogIn($error = '') {
      require_once "./templates/layouts/formLogIn.phtml";
    }
  }