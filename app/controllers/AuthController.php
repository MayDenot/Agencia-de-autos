<?php 
  require_once "./app/models/UserModel.php";
  require_once "./app/views/AuthView.php";

  class AuthController {
    private $model;
    private $view;

    public function __construct() {
      $this->model = new UserModel();
      $this->view = new AuthView();
    }

    public function showLogin() {
      return $this->view->showLogIn();
    }

    public function login() {
      if (!isset($_POST['usuario']) || empty($_POST['usuario'])) {
        return $this->view->showLogIn("Falta completar el nombre de usuario");
      }
      if (!isset($_POST['contraseña']) || empty($_POST['contraseña'])) {
        return $this->view->showLogIn("Falta completar la contraseña");
      }

      $usuario = $_POST['usuario'];
      $contraseña = $_POST['contraseña'];

      $userFromDB = $this->model->getUserByUsername($usuario);

      if ($userFromDB && password_verify($contraseña, $userFromDB->Contraseña)) {
        $_SESSION['ID_USER'] = $userFromDB->ID_Usuario;
        $_SESSION['USER_NAME'] = $userFromDB->Usuario;

        header("Location: " . BASE_URL); 
      } else {
        return $this->view->showLogIn('Credenciales incorrectas');
      }
    }
  }