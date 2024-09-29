<?php
    require_once './app/models/vehiculos.model.php';
    require_once './app/views/Vehiculos.view.php';

    class VehiculosController {
        private $model;
        private $view;

        public function __construct() {
            $this->model = new VehiculosModel();
            $this->view = new VehiculosView();
        }

        public function showVehiculos() {
            $vehiculos = $this->model->getVehiculos();
            $this->view->showVehiculos($vehiculos);
        }
}

