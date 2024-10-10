<?php 
  require_once "./config.php";
  require_once './app/models/Model.php';

  class UserModel extends Model {
    public function getUserByUsername($username) {
      $query = $this->db->prepare('SELECT * FROM usuarios WHERE Usuario = ?');
      $query->execute([$username]);

      $user = $query->fetch(PDO::FETCH_OBJ);
        
      return $user;
    }
  }