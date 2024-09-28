<?php 
  require_once "./app/controllers/ItemController.php";

  class ItemView {
    public function showItems($items, $categories) {
      $countItems = count($items); 
      $countCategories = count($categories); 
      require_once "./templates/listItems.phtml";
    }

    public function showItem($item) {
      require_once "./templates/itemDetails.phtml";
    }

    public function showFormLogIn() {
      require_once "./templates/layouts/formLogIn.phtml";
    }

    public function showError($error) {
      require_once "./templates/error.phtml";
    }
  }