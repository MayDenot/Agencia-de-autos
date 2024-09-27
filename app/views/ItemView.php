<?php 
  require_once "./app/controllers/ItemController.php";

  class ItemView {

    public function showItems($items) {
      $count = count($items); 
      require_once "./templates/listItems.phtml";
    }

    public function showItem($item) {
      require_once "./templates/vehicleDetails.phtml";
    }
  }