<?php
  require_once "./app/controllers/ItemController.php";

  define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

  $action = 'listar';

  if (!empty($_GET['action'])) {
    $action = $_GET['action'];
  }

  $params = explode('/', $action);

  // tabla de ruteo
  // list -> ItemController->showItems()
  // item -> ItemController->showItem(id)

  switch ($params[0]) {
    case 'listar':
      $controller = new ItemController();
      $controller->showItems();
      break;
    case 'vehiculo':
      $id = null;
      if (isset($params[1])) $id = $params[1];
      $controller = new ItemController();
      $controller->showItem($id);
      break;
    default:
      echo ('404 Page not found');
      break;
  }
