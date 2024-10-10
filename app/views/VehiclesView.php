<?php
    require_once './app/controllers/VehiclesController.php';

    class VehiclesView {
        private $user = null;

        public function __construct($user) {
            $this->user = $user;
        }

        public function showVehicles($vehicles) {
            $edit = false;
            require_once "./templates/listVehicles.phtml";
        }

        public function showVehicle($vehicle) {
            require_once './templates/vehicleDetails.phtml';
        }

        public function editVehicle($vehicles, $vehicle) {
            $edit = true;
            require_once './templates/listVehicles.phtml';
        }

        public function showError($error) {
            require_once "./templates/error.phtml";
        }
    }