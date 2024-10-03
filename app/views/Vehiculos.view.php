<?php
    require_once './app/controllers/Vehiculos.Controller.php';

    class VehiculosView {
        private $user = null;

        public function __construct($user) {
            $this->user = $user;
        }

        public function showVehiculos($vehiculos) {
            $count = count($vehiculos);

            require './templates/listVehiculos.phtml';
        }

        public function showVehiculo($vehiculo) {
            require './templates/detallesVehiculo.phtml';
        }

        public function showError($error) {
            require_once "./templates/error.phtml";
        }
    }