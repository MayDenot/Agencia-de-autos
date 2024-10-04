<?php 
  require_once "./app/controllers/ItemController.php";

  class ItemView {
    private $user = null;

    public function __construct($user) {
      $this->user = $user;
    }

    public function showItems($items, $categories) {
      $editar = false;
      require_once "./templates/listItems.phtml";
    }

    public function showItem($item, $categories) {
      require_once "./templates/itemDetails.phtml";
    }
  
    public function showFormLogIn() {
      require_once "./templates/layouts/formLogIn.phtml";
    }

    public function showError($error) {
      require_once "./templates/error.phtml";
    }

    public function editItem($items, $item, $categories) {
      $editar = true;
      require_once "./templates/listItems.phtml";
    }
  }