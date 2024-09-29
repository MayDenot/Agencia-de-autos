<?php 
  require_once "./config.php";

  class ItemModel {
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

    public function getAllItems() {
      $query = $this->db->prepare('SELECT * FROM alquileres');
      $query->execute();

      $items = $query->fetchAll(PDO::FETCH_OBJ);
        
      return $items;
    }

    public function getItemById($id) {
      $query = $this->db->prepare('SELECT * FROM alquileres WHERE ID = ?');
      $query->execute([$id]);

      $item = $query->fetch(PDO::FETCH_OBJ);

      return $item;
    }

    public function insertItem($vehiculoAlquilar, $fechaDeEntrega, $fechaDeVencimiento, $precio) {
      $query = $this->db->prepare('INSERT INTO alquileres(ID, ID_Vehiculo, Fecha_de_entrega, Fecha_de_vencimiento, Precio) VALUES(?,?,?,?,?)');
      $query->execute([null, $vehiculoAlquilar, $fechaDeEntrega, $fechaDeVencimiento, $precio]);
    }

    public function deleteItemById($id) {
      $query = $this->db->prepare('DELETE FROM alquileres WHERE ID = ?');
      $query->execute([$id]);
    }

    public function updateItemById($idVehiculo, $fechaDeEntrega, $fechaDeVencimiento, $precio, $id) {
      $query = $this->db->prepare('UPDATE alquileres SET ID_Vehiculo = ?, Fecha_de_entrega = ?, Fecha_de_vencimiento = ?, Precio = ? WHERE ID = ?');
      $query->execute([$idVehiculo, $fechaDeEntrega, $fechaDeVencimiento, $precio, $id]);
    }
  }