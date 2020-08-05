<?php

header ("Access-Control-Allow-Origin: *");
header ("Content-type: application/json; charset=UTF-8");

require_once ("../config/database.php");
require_once ("../objects/product.php");

$database = new Database();
$db = $database->open_link();

$product = new Product($db);

$stmt = $product->read();
$rows = $stmt->rowCount();

if ($rows > 0) {
  
  $prod_arr = array();
  $prod_arr["records"] = array();
  
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    
    $prod_item = array(
    "id" => $id,
    "name" => $name,
    "description" => html_entity_decode($description),
    "price" => $price,
    "category_id" => $cat_id,
    "category_name" => $cat_name,
    );
    
    $prod_arr["records"] = $prod_item;
  }
  
  http_response_code(200);
  
  echo json_encode($prod_arr);
  
} 
else {
  
  http_response_code(400);
  
  $mess = array(
  "message" => "No products found",
  );
  
  echo json_encode($mess);
}

?>