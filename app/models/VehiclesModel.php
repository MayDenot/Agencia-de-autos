<?php
    require_once './config.php';
    require_once './app/models/Model.php';

    class VehiclesModel extends Model{
        
        public function getVehicles() {
            $query = $this->db->prepare('SELECT * FROM vehiculos');
            $query->execute();

            $vehicles = $query->fetchAll(PDO::FETCH_OBJ);

            return $vehicles;
        }

        public function getVehicleById($id) {
            $query = $this->db->prepare('SELECT * FROM vehiculos WHERE ID_Vehiculo = ?');
            $query->execute([$id]);

            $vehicle = $query->fetch(PDO::FETCH_OBJ);

            return $vehicle;
        }

        public function deleteVehicle($id) {
            $query = $this->db->prepare('DELETE FROM vehiculos WHERE ID_Vehiculo = ?');
            $query->execute([$id]);
        }

        public function insertVehicle($patente,$modelo,$marca,$anio,$color,$imagen) {
            $query = $this->db->prepare('INSERT INTO vehiculos(Patente, Modelo, Marca, Año_de_Modelo, Color, Imagen) VALUES (?,?,?,?,?,?)');
            $query->execute([$patente,$modelo,$marca,$anio,$color,$imagen]);

            return $this->db->lastInsertId();
        }

        public function editVehicle($patente,$modelo,$marca,$anio,$color,$imagen,$id) {
            $query = $this->db->prepare('UPDATE vehiculos SET Patente = ?, Modelo = ?, Marca = ?, Año_de_Modelo = ?, Color = ?, Imagen = ? WHERE ID_Vehiculo = ?');
            $query->execute([$patente,$modelo,$marca,$anio,$color,$imagen,$id]);
        }
    }