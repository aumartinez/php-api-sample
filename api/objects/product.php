<?php

class Product {
  
  private $conx;
  private $table_name = "products";
  
  public $id;
  public $name;
  public $description;
  public $price;
  public $category_id;
  public $category_name;
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
              FROM {$this->table_name} p
              LEFT JOIN categories c
              ON p.category_id = c.id
              ORDER BY p.created DESC";
              
    $stmt = $this->conx->prepare($query);
    $stmt->execute();
    
    return $stmt;
  }
  
  public function create() {
    $query = "INSERT INTO {$this->table_name}
              SET
              name=:name,
              price=:price,
              description=:description,
              category_id=:category_id,
              created=:created";
              
    $stmt = $this->conx->prepare($query);
    
    # Sanitization
    $this->name = htmlspecialchars(strip_tags($this->name));
  }
  
}

?>