<?php 
  require_once "./app/models/ItemModel.php";
  require_once "./app/views/ItemView.php";

  class ItemController {
    private $model;
    private $view;

    public function __construct() {
      $this->model = new ItemModel();
      $this->view = new ItemView();

      //Seguridad
    }

    public function showItems() {
      $items = $this->model->getAllItems();
      $categories = $this->model->getAllCategories();
      $this->view->showItems($items, $categories);
    }

    public function showItem($id) {
      $item = $this->model->getItemById($id);
      $this->view->showItem($item);
    }

    public function addItem() {
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

      $id = $this->model->insertItem($vehiculoAlquilar, $fechaDeEntrega, $fechaDeVencimiento, $precio);

      header("Location: " . BASE_URL); 
    }

    public function deleteItem($id) {
      $this->model->deleteItemById($id);
      
      header("Location: " . BASE_URL);
    }

    public function updateItem() {
      
    }

    public function login() {
      $this->view->showFormLogIn();
    }
  }