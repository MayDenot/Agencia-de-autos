<?php 
  require_once "./app/controllers/ItemController.php";

  class ItemView {
    private $user = null;

    public function __construct($user) {
      $this->user = $user;
    }

    public function showItems($items, $categories) {
      $editar = false;
      $countCat = 0;
      var_dump($categories['ID_Vehiculo']->ID_Vehiculo);
      require_once "./templates/listItems.phtml";
    }

    public function showItem($item, $category) {
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