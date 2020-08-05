<?php

class Database {
  
  # DB credentials  
  private $host = "localhost";
  private $db_name = "api_db";
  private $db_user = "root";
  private $db_pass = "";
  
  public $conx;
  
  public function open_link() {
    $this->conx = null;
    
    try{
      $this->conx = new PDO("mysql:host=" . $this->host . "; dbname=" . $this->db_name; $this->db_user; $this->db_pass);
      $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
    
    return $this->conx;
  }
  
}

?>