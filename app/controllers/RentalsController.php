<?php
require_once "./app/models/RentalsModel.php";
require_once "./app/models/VehiclesModel.php";
require_once "./app/views/RentalsView.php";

class RentalsController {
  private $model;
  private $modelVehicle;
  private $view;
  private $rentals;
  private $vehicles;

  public function __construct($res) {
    $this->model = new RentalsModel();
    $this->modelVehicle = new VehiclesModel();
    $this->view = new RentalsView($res->user);
    $this->rentals = $this->model->getAllRentals();
    $this->vehicles = $this->modelVehicle->getVehicles();
  }

  public function showRentals() {
    $this->view->showRentals($this->rentals, $this->vehicles);
  }

  public function showRent($id) {
    $rent = $this->model->getRentById($id);
    $this->view->showRent($rent, $this->vehicles);
  }

  public function addRent() {
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

    $this->model->insertRent($vehiculoAlquilar, $fechaDeEntrega, $fechaDeVencimiento, $precio);

    header("Location: " . BASE_URL);
  }

  public function deleteRent($id) {
    $this->model->deleteRentById($id);

    header("Location: " . BASE_URL);
  }

  public function updateRent($id) {
    $rent = $this->model->getRentById($id);

    if (!$rent) {
      return $this->view->showError("No existe el alquiler con el id = $id");
    }

    $this->view->editRent($this->rentals, $rent, $this->vehicles);

    header('Location: ' . BASE_URL . 'finalizarEdicionAlquiler');
  }

  public function finishedEdit($id) {
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

    $this->model->updateRentById($vehiculoAlquilar, $fechaDeEntrega, $fechaDeVencimiento, $precio, $id);

    header('Location: ' . BASE_URL);
  }
}
