<?php
require_once "./app/models/ItemModel.php";
require_once "./app/models/Vehiculos.model.php";
require_once "./app/views/ItemView.php";

class ItemController
{
  private $model;
  private $modelVehiculo;
  private $view;
  private $items;
  protected $categories;

  public function __construct($res)
  {
    $this->model = new ItemModel();
    $this->modelVehiculo = new VehiculosModel();
    $this->view = new ItemView($res->user);
    $this->items = $this->model->getAllItems();
    $this->categories = $this->modelVehiculo->getVehiculos();
  }

  public function showItems()
  {
    $this->view->showItems($this->items, $this->categories);
  }

  public function showItem($id)
  {
    $item = $this->model->getItemById($id);
    $this->view->showItem($item, $this->categories);
  }

  public function addItem()
  {
    if (!isset($_POST['vehiculo_alquilar']) || empty($_POST['vehiculo_alquilar'])) {
      return $this->view->showError("Falta seleccionar una vehículo");
    }
    if (!isset($_POST['fecha_entrega']) || empty($_POST['fecha_entrega'])) {
      return $this->view->showError("Falta seleccionar una fecha de entrega");
    }
    if (!isset($_POST['fecha_vencimiento']) || empty($_POST['fecha_vencimiento'])) {
      return $this->view->showError("Falta seleccionar una fecha de vencimiento");
    }
    if (!isset($_POST['precio']) || empty($_POST['precio'])) {
      return $this->view->showError("Falta seleccionar una precio");
    }

    $vehiculoAlquilar = $_POST['vehiculo_alquilar'];
    $fechaDeEntrega = $_POST['fecha_entrega'];
    $fechaDeVencimiento = $_POST['fecha_vencimiento'];
    $precio = $_POST['precio'];

    $this->model->insertItem($vehiculoAlquilar, $fechaDeEntrega, $fechaDeVencimiento, $precio);

    header("Location: " . BASE_URL);
  }

  public function deleteItem($id)
  {
    $this->model->deleteItemById($id);

    header("Location: " . BASE_URL);
  }

  public function updateItem($id)
  {
    $item = $this->model->getItemById($id);

    if (!$item) {
      return $this->view->showError("No existe el alquiler con el id = $id");
    }

    $this->view->editItem($this->items, $item, $this->categories);

    header('Location: ' . BASE_URL . 'finalizarEdicionAlquiler');
  }

  public function finishedEdit($id)
  {
    if (!isset($_POST['vehiculo_alquilar']) || empty($_POST['vehiculo_alquilar'])) {
      return $this->view->showError("Falta seleccionar una vehículo");
    }
    if (!isset($_POST['fecha_entrega']) || empty($_POST['fecha_entrega'])) {
      return $this->view->showError("Falta seleccionar una fecha de entrega");
    }
    if (!isset($_POST['fecha_vencimiento']) || empty($_POST['fecha_vencimiento'])) {
      return $this->view->showError("Falta seleccionar una fecha de vencimiento");
    }
    if (!isset($_POST['precio']) || empty($_POST['precio'])) {
      return $this->view->showError("Falta completar el precio");
    }

    $vehiculoAlquilar = $_POST['vehiculo_alquilar'];
    $fechaDeEntrega = $_POST['fecha_entrega'];
    $fechaDeVencimiento = $_POST['fecha_vencimiento'];
    $precio = $_POST['precio'];

    $this->model->updateItemById($vehiculoAlquilar, $fechaDeEntrega, $fechaDeVencimiento, $precio, $id);

    header('Location: ' . BASE_URL);
  }
}
