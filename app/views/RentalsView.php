<?php 
  require_once "./app/controllers/RentalsController.php";

  class RentalsView {
    private $user = null;

    public function __construct($user) {
      $this->user = $user;
    }

    public function showRentals($rentals, $vehicles) {
      $edit = false;
      require_once "./templates/listRentals.phtml";
    }

    public function showRent($rent, $vehicles) {
      require_once "./templates/rentDetails.phtml";
    }
  
    public function showFormLogIn() {
      require_once "./templates/layouts/formLogIn.phtml";
    }

    public function showError($error) {
      require_once "./templates/error.phtml";
    }

    public function editRent($rentals, $rent, $vehicles) {
      $edit = true;
      require_once "./templates/listRentals.phtml";
    }
  }