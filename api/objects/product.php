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
  
  public function __construct(string $db) {
    $this->conx = $db;
  }
  
}

?>