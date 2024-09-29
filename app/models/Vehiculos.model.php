<?php
    require_once './config.php';

    class VehiculosModel {
        private $db;

        public function __construct() {
            $this->db = new PDO('mysql:host='. MYSQL_HOST . ';dbname='.MYSQL_DB.';charset=utf8', MYSQL_USER, MYSQL_PASS);
            $this->_deploy();
        }

        private function _deploy() {
            $query = $this->db->query('SHOW TABLES');
            $tables = $query->fetchAll();
      
            if(count($tables) == 0) {
                $sql =<<<END
                CREATE TABLE `alquileres` (
                `ID` int(11) NOT NULL,
                `ID_Vehiculo` int(11) NOT NULL,
                `Fecha_de_entrega` date NOT NULL,
                `Fecha_de_vencimiento` date NOT NULL,
                `Precio` double NOT NULL);
                
                CREATE TABLE `vehiculos` (
                `ID_Vehiculo` int(11) NOT NULL,
                `Patente` varchar(45) NOT NULL,
                `Modelo` varchar(45) NOT NULL,
                `Marca` varchar(45) NOT NULL),
                `Año_de_Modelo` year(4) NOT NULL,
                `Color` varchar(40) NOT NULL;
                END;
              $this->db->query($sql);
            }
          }
        
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
            $query = $this->db->prepare('DELETE * FROM vehiculos WHERE ID = ?');
            $query->execute([$id]);
        }

        public function insertVehiculo($patente,$modelo,$marca,$anio,$color) {
            $query = $this->db->prepare('INSERT INTO vehiculos(Patente, Modelo, Marca,Año_de_Modelo, Color) VALUES (?,?,?,?');
            $query->execute([$patente,$modelo,$marca,$anio,$color]);
        }

        public function editVehiculo($id,$patente,$modelo,$marca,$anio,$color) {
            $query = $this->db->prepare('UPDATE vehiculos SET Patente = ?, Modelo = ?, Marca = ?, Año_de_Modelo = ?, Color = ? WHERE ID = ?');
            $query->execute([$patente,$modelo,$marca,$anio,$color,$id]);
        }
    }