<?php
    require_once './config.php';
    require_once './app/models/model.php';

    class VehiculosModel extends Model{
        
        public function getVehiculos() {
            $query = $this->db->prepare('SELECT * FROM vehiculos');
            $query->execute();

            $vehiculos = $query->fetchAll(PDO::FETCH_OBJ);

            return $vehiculos;
        }

        public function getVehiculoById($id) {
            $query = $this->db->prepare('SELECT * FROM vehiculos WHERE ID_Vehiculo = ?');
            $query->execute([$id]);

            $vehiculo = $query->fetch(PDO::FETCH_OBJ);

            return $vehiculo;
        }

        public function deleteVehiculo($id) {
            $query = $this->db->prepare('DELETE FROM vehiculos WHERE ID_Vehiculo = ?');
            $query->execute([$id]);
        }

        public function insertVehiculo($patente,$modelo,$marca,$anio,$color,$imagen) {
            $query = $this->db->prepare('INSERT INTO vehiculos(Patente, Modelo, Marca, Año_de_Modelo, Color, Imagen) VALUES (?,?,?,?,?,?)');
            $query->execute([$patente,$modelo,$marca,$anio,$color,$imagen]);

            return $this->db->lastInsertId();
        }

        public function editVehiculo($patente,$modelo,$marca,$anio,$color,$imagen,$id) {
            $query = $this->db->prepare('UPDATE vehiculos SET Patente = ?, Modelo = ?, Marca = ?, Año_de_Modelo = ?, Color = ?, Imagen = ? WHERE ID = ?');
            $query->execute([$patente,$modelo,$marca,$anio,$color,$imagen,$id]);
        }
    }