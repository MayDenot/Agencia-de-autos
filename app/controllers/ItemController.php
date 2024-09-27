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
      $this->view->showItems($items);
    }

    public function showItem($id) {
      $item = $this->model->getItemById($id);
      $this->view->showItem($item);
    }

    public function addItem() {
      $patente = $_POST['patente'];
      $modelo = $_POST['modelo'];
      $marca = $_POST['marca'];

      $id = $this->model->insertItem($patente, $modelo, $marca);

      header("Location: " . BASE_URL); 
    }

    public function deleteItem($id) {
      $this->model->deleteItemById($id);
      header("Location: " . BASE_URL);
    }

    public function updateItem() {
      
    }
  }