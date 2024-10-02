<?php 
  require_once "./config.php";
  require_once './app/models/model.php';

  class ItemModel extends Model {    
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

    public function insertItem($idVehiculo, $idUsuario, $fechaDeEntrega, $fechaDeVencimiento, $precio) {
      $query = $this->db->prepare('INSERT INTO alquileres(ID, ID_Vehiculo, ID_Usuario, Fecha_de_entrega, Fecha_de_vencimiento, Precio) VALUES(?,?,?,?,?,?)');
      $query->execute([null, $idVehiculo, $idUsuario, $fechaDeEntrega, $fechaDeVencimiento, $precio]);
    }

    public function deleteItemById($id) {
      $query = $this->db->prepare('DELETE FROM alquileres WHERE ID = ?');
      $query->execute([$id]);
    }

    public function updateItemById($idVehiculo, $idUsuario, $fechaDeEntrega, $fechaDeVencimiento, $precio, $id) {
      $query = $this->db->prepare('UPDATE alquileres SET ID_Vehiculo = ?, ID_Usuario = ?, Fecha_de_entrega = ?, Fecha_de_vencimiento = ?, Precio = ? WHERE ID = ?');
      $query->execute([$idVehiculo, $idUsuario, $fechaDeEntrega, $fechaDeVencimiento, $precio, $id]);
    }
  }