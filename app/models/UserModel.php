<?php 
  require_once "./config.php";
  require_once './app/models/model.php';

  class UserModel extends Model {
    protected $db;

    public function __construct() {
      $this->db = new PDO('mysql:host='. MYSQL_HOST .';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
    }

    public function getUserByUsername($user) {
      $query = $this->db->prepare('SELECT * FROM usuarios WHERE Usuario = ?');
      $query->execute([$user]);

      $user = $query->fetch(PDO::FETCH_OBJ);
        
      return $user;
    }
  }