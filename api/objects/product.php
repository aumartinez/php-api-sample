<?php

class Product {
  
  private $conx;
  private $table_name;
  
  public $id;
  public $name;
  public $description;
  public $price;
  public $cat_id;
  public $cat_name;
  public $created;
  
  public function __construct($db) {
    $this->conx = $db;
  }
  
  public function read() {
    $query = "SELECT 
              c.name AS category_name,
              p.id,
              p.name,
              p.description,
              p.price,
              p.category_id,
              p.created
              FROM ". $this->table_name ." p
              LEFT JOIN categories c
              ON p.category_id = c.id
              ORDER BY p.created DESC";
              
    $stmt = $this->conx->prepare($query);
    $stmt->execute();
    
    return $stmt;
  }
  
}

?>