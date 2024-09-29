<?php
require_once "./app/controllers/ItemController.php";
require_once "./app/controllers/Vehiculos.Controller.php";

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'listar';

if (!empty($_GET['action'])) {
  $action = $_GET['action'];
}

$params = explode('/', $action);

// tabla de ruteo
// listar -> ItemController->showItems()
// alquiler -> ItemController->showItem(id)
// nuevoAlquiler -> ItemController->addItem()
// eliminarAlquiler -> ItemController->deleteItem(id)
// vehiculos -> VehiculosController->showVehiculos();

switch ($params[0]) {
  case 'listar':
    $controller = new ItemController();
    $controller->showItems();
    break;
  case 'alquiler':
    $id = null;
    if (isset($params[1])) $id = $params[1];
    $controller = new ItemController();
    $controller->showItem($id);
    break;
  case 'nuevoAlquiler':
    $controller = new ItemController();
    $controller->addItem();
    break;
  case 'eliminarAlquiler':
    $controller = new ItemController();
    $controller->deleteItem($params[1]);
    break;
  case 'login':
    $controller = new ItemController();
    $controller->login();
    break;
  case 'vehiculos':
    $controller = new VehiculosController();
    $controller->showVehiculos();
  default:
    echo ('404 Page not found');
    break;
}
