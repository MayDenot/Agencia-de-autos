<?php
    require_once './app/controllers/Vehiculos.Controller.php';

    class VehiculosView {

        public function showVehiculos($vehiculos) {
            $count = count($vehiculos);

            require './templates/listVehiculos.phtml';
        }
    }