<?php
    require_once './app/models/vehiculos.model.php';
    require_once './app/views/Vehiculos.view.php';

    class VehiculosController {
        private $model;
        private $view;

        public function __construct($res) {
            $this->model = new VehiculosModel();
            $this->view = new VehiculosView($res->user);
        }

        public function showVehiculos() {
            $vehiculos = $this->model->getVehiculos();
            $this->view->showVehiculos($vehiculos);
        }

        public function showVehiculo($id) {
            $vehiculo = $this->model->getVehiculoById($id);
            $this->view->showVehiculo($vehiculo);
        }

        public function addVehiculo() {
            
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
            
            $id = $this->model->insertVehiculo($patente,$modelo,$marca,$anio,$color,$imagen);
            
            if ($id) {
                header('Location: ' . BASE_URL . '/vehiculos');
            }
            else {
                $this->view->showError("Error al cargar vehiculo");
            }
        }

        public function updateVehiculo() {
            
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
            
            $id = $this->model->editVehiculo($patente,$modelo,$marca,$anio,$color,$imagen);
            
            if ($id)
            header('Location: ' . BASE_URL . 'vehiculos');
            else
                $this->view->showError("Error al actualizar el vehiculo");
        }

        public function removeVehiculo($id) {
            $this->model->deleteVehiculo($id);
            header('Location: ' . BASE_URL . 'vehiculos');
        }
    }


