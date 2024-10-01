<?php
require_once "./libs/response.php";
require_once "./app/middlewares/SessionAuthMiddleware.php";
require_once "./app/controllers/AuthController.php";
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
// editarAlquiler -> ItemController->updateItem(id)
// vehiculos -> VehiculosController->showVehiculos();

switch ($params[0]) {
  case 'listar':
    sessionAuthMiddleware($res);
    $controller = new ItemController($res);
    $controller->showItems();
    break;
  case 'alquiler':
    sessionAuthMiddleware($res);
    $id = null;
    if (isset($params[1])) $id = $params[1];
    $controller = new ItemController($res);
    $controller->showItem($id);
    break;
  case 'nuevoAlquiler':
    sessionAuthMiddleware($res);
    $controller = new ItemController($res);
    $controller->addItem();
    break;
  case 'eliminarAlquiler':
    sessionAuthMiddleware($res);
    $controller = new ItemController($res);
    $controller->deleteItem($params[1]);
    break;
  case 'editarAlquiler':
    sessionAuthMiddleware($res);
    $controller = new ItemController($res);
    $controller->updateItem($params[1]);
    break;
  case 'showLogin':
    $controller = new AuthController();
    $controller->showLogin();
    break;
  case 'login':
    $controller = new ItemController();
    $controller->login();
    break;
  case 'vehiculos':
    sessionAuthMiddleware($res);
    $controller = new VehiculosController($res);
    $controller->showVehiculos();
  case 'nuevoVehiculo':
    sessionAuthMiddleware($res);
    $controller = new VehiculosController($res);
    $controller->addVehiculo();
  case 'eliminarVehiculo':
    sessionAuthMiddleware($res);
    $controller = new VehiculosController($res);
    $controller->removeVehiculo($params[1]);
  case 'editarVehiculo':
    sessionAuthMiddleware($res);
    $controller = new VehiculosController($res);
    $controller->updateVehiculo($params[1]);
  default:
    echo ('404 Page not found');
    break;
}
