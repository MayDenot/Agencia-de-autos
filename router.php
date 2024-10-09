<?php
require_once "./libs/response.php";
require_once "./app/middlewares/SessionAuthMiddleware.php";
require_once "./app/middlewares/VerifyAuthMiddleware.php";
require_once "./app/controllers/AuthController.php";
require_once "./app/controllers/ItemController.php";
require_once "./app/controllers/Vehiculos.Controller.php";

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$res = new Response();

$action = 'listar';
if (!empty($_GET['action'])) {
  $action = $_GET['action'];
}

$params = explode('/', $action);
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
    verifyAuthMiddleware($res);
    $controller = new ItemController($res);
    $controller->addItem();
    break;
  case 'eliminarAlquiler':
    sessionAuthMiddleware($res);
    verifyAuthMiddleware($res);
    $controller = new ItemController($res);
    $controller->deleteItem($params[1]);
    break;
  case 'editarAlquiler':
    sessionAuthMiddleware($res);
    verifyAuthMiddleware($res);
    $controller = new ItemController($res);
    $controller->updateItem($params[1]);
    break;
  case 'showLogin':
    $controller = new AuthController();
    $controller->showLogin();
    break;
  case 'login':
    $controller = new AuthController();
    $controller->login();
    break;
  case 'vehiculos':
    sessionAuthMiddleware($res);
    $controller = new VehiculosController($res);
    $controller->showVehiculos();
    break;
  case 'vehiculo':
    sessionAuthMiddleware($res);
    $id = null;
    if (isset($params[1])) $id = $params[1];
    $controller = new VehiculosController($res);
    $controller->showVehiculo($id);
    break;
  case 'nuevoVehiculo':
    sessionAuthMiddleware($res);
    verifyAuthMiddleware($res);
    $controller = new VehiculosController($res);
    $controller->addVehiculo();
    break;
  case 'eliminarVehiculo':
    sessionAuthMiddleware($res);
    verifyAuthMiddleware($res);
    $id = null;
    if (isset($params[1])) $id = $params[1];
    $controller = new VehiculosController($res);
    $controller->removeVehiculo($id);
    break;
  case 'editarVehiculo':
    sessionAuthMiddleware($res);
    verifyAuthMiddleware($res);
    $controller = new VehiculosController($res);
    $controller->updateVehiculo($params[1]);
    break;
  case 'finalizarEdicionVehiculo':
    sessionAuthMiddleware($res);
    verifyAuthMiddleware($res);
    $controller = new VehiculosController($res);
    $controller->finishedEdit($params[1]);
    break;
  case 'finalizarEdicionAlquiler':
      sessionAuthMiddleware($res);
      verifyAuthMiddleware($res);
      $controller = new ItemController($res);
      $controller->finishedEdit($params[1]);
      break;
  case 'logout':
    $controller = new AuthController();
    $controller->logout();
    break;
  default:
    $controller = new AuthController();
    $controller->showError();
    break;
}