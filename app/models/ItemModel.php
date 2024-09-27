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
          `Marca` varchar(45) NOT NULL);
          END;
        $this->db->query($sql);
      }
    }

    public function getAllItems() {
      $query = $this->db->prepare("SELECT * FROM vehiculos");
      $query->execute();

      $items = $query->fetchAll(PDO::FETCH_OBJ);
        
      return $items;
    }

    public function getItemById($id) {
      $query = $this->db->prepare("SELECT * FROM vehiculos WHERE ID_Vehiculo = ?");
      $query->execute([$id]);

      $item = $query->fetch(PDO::FETCH_OBJ);

      return $item;
    }

    public function insertItem($patente, $modelo, $marca) {
      $query = $this->db->prepare("INSERT INTO vehiculos(ID_Vehiculo, Patente, Modelo, Marca) VALUES(?,?,?,?)");
      $query->execute([null, $patente, $modelo, $marca]);
    }

    public function deleteItemById($id) {
      $query = $this->db->prepare('DELETE FROM vehiculos WHERE ID_Vehiculo = ?');
      $query->execute([$id]);
    }
  }