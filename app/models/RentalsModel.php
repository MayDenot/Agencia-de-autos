<?php 
  require_once "./config.php";
  require_once './app/models/Model.php';

  class RentalsModel extends Model {    
    public function getAllRentals() {
      $query = $this->db->prepare('SELECT * FROM alquileres');
      $query->execute();

      $rentals = $query->fetchAll(PDO::FETCH_OBJ);
        
      return $rentals;
    }

    public function getRentById($id) {
      $query = $this->db->prepare('SELECT * FROM alquileres WHERE ID = ?');
      $query->execute([$id]);

      $rent = $query->fetch(PDO::FETCH_OBJ);

      return $rent;
    }
    
    public function insertRent($idVehiculo, $fechaDeEntrega, $fechaDeVencimiento, $precio) {
      $query = $this->db->prepare('INSERT INTO alquileres(ID_Vehiculo, Fecha_de_entrega, Fecha_de_vencimiento, Precio) VALUES(?,?,?,?)');
      $query->execute([$idVehiculo, $fechaDeEntrega, $fechaDeVencimiento, $precio]);

      return $this->db->lastInsertId();
    }

    public function deleteRentById($id) {
      $query = $this->db->prepare('DELETE FROM alquileres WHERE ID = ?');
      $query->execute([$id]);
    }

    public function updateRentById($idVehiculo, $fechaDeEntrega, $fechaDeVencimiento, $precio, $id) {
      $query = $this->db->prepare('UPDATE alquileres SET ID_Vehiculo = ?, Fecha_de_entrega = ?, Fecha_de_vencimiento = ?, Precio = ? WHERE ID = ?');
      $query->execute([$idVehiculo, $fechaDeEntrega, $fechaDeVencimiento, $precio, $id]);
    }
  }