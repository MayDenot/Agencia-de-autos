<?php
    require_once './app/models/VehiclesModel.php';
    require_once './app/views/VehiclesView.php';

    class VehiclesController {
        private $model;
        private $view;

        public function __construct($res) {
            $this->model = new VehiclesModel();
            $this->view = new VehiclesView($res->user);
        }

        public function showVehicles() {
            $vehicles = $this->model->getVehicles();
            $this->view->showVehicles($vehicles);
        }

        public function showVehicle($id) {
            $vehicle = $this->model->getVehicleById($id);
            $this->view->showVehicle($vehicle);
        }

        public function addVehicle() {
            if (!isset($_POST['patente']) || empty($_POST['patente'])) {
                return $this->view->showError("Falta Patente del Vehiculo");
            }
            
            if (!isset($_POST['modelo']) || empty($_POST['modelo'])) {
                return $this->view->showError("Falta Modelo del Vehiculo");
            }
            
            if (!isset($_POST['marca']) || empty($_POST['marca'])) {
                return $this->view->showError("Falta Marca del Vehiculo");
            }
            
            if (!isset($_POST['anio']) || empty($_POST['anio'])) {
                return $this->view->showError("Falta Año del Vehiculo");
            }
            
            if (!isset($_POST['color']) || empty($_POST['color'])) {
                return $this->view->showError("Falta Color del Vehiculo");
            }

            if (!isset($_POST['imagen']) || empty($_POST['imagen'])) {
                return $this->view->showError("Falta Imagen del Vehiculo");
            }
            
            $patente = $_POST['patente'];
            $modelo = $_POST['modelo'];
            $marca = $_POST['marca'];
            $anio = $_POST['anio'];
            $color = $_POST['color'];
            $imagen = $_POST['imagen'];
            
            $this->model->insertVehicle($patente,$modelo,$marca,$anio,$color,$imagen);
            
            header('Location: ' . BASE_URL . 'vehiculos');
        }

        public function updateVehicle($id) {
            $vehicle = $this->model->getVehicleById($id);

            if (!$vehicle) {
                return $this->view->showError("No existe el vehiculo");
            }

            $vehicles = $this->model->getVehicles();
            
            $this->view->editVehicle($vehicles, $vehicle);
            
            header('Location: ' . BASE_URL . 'finalizarEdicionVehiculo');
        }
        
        public function finishedEdit($id) {
            if (!isset($_POST['patente']) || empty($_POST['patente'])) {
                return $this->view->showError("Falta Patente del Vehiculo");
            }
            
            if (!isset($_POST['modelo']) || empty($_POST['modelo'])) {
                return $this->view->showError("Falta Modelo del Vehiculo");
            }
            
            if (!isset($_POST['marca']) || empty($_POST['marca'])) {
                return $this->view->showError("Falta Marca del Vehiculo");
            }

            if (!isset($_POST['anio']) || empty($_POST['anio'])) {
                return $this->view->showError("Falta Año del Vehiculo");
            }
            
            if (!isset($_POST['color']) || empty($_POST['color'])) {
                return $this->view->showError("Falta Color del Vehiculo");
            }

            if (!isset($_POST['imagen']) || empty($_POST['imagen'])) {
                return $this->view->showError("Falta Imagen del Vehiculo");
            }
            
            $patente = $_POST['patente'];
            $modelo = $_POST['modelo'];
            $marca = $_POST['marca'];
            $anio = $_POST['anio'];
            $color = $_POST['color'];
            $imagen = $_POST['imagen'];
            
            $this->model->editVehicle($patente,$modelo,$marca,$anio,$color,$imagen,$id);
            header('Location: ' . BASE_URL . 'vehiculos');
        }

        public function removeVehicle($id) {
            $this->model->deleteVehicle($id);
            header('Location: ' . BASE_URL . 'vehiculos');
        }
    }