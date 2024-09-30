<?php
    require_once './app/controllers/Vehiculos.Controller.php';

    class VehiculosView {

        public function showVehiculos($vehiculos) {
            $count = count($vehiculos);

            require './templates/listVehiculos.phtml';
        }

        public function showError($error) {
            require_once "./templates/error.phtml";
        }
    }