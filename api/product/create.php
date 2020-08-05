<?php

header ("Access-Control-Allow-Origin: *");
header ("Content-type: application/json; charset=UTF-8");
header ("Access-Control-Allow-Methods: POST");
header ("Access-Control-Max-Age: 3600");
header ("Access-Control-Allow-Headers: Content-type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once ("../config/database.php");
require_once ("../objects/product.php");

$database = new Database();
$db = $database->open_link();

$product = new Product($db);

$data = json_decode(file_get_contents("php://input"));

if (
!empty($data->name) && 
!empty($data->price) && 
!empty($data->description) && 
!empty($data->category_id)) {

  $product->name = $data->name;
  $product->price = $data->price;
  $product->description = $data->description;
  $product->category_id = $data->category_id;
  $product->created = date("Y-m-d H:i:s");
  
  if ($product->create()) {
    http_response_code(201);
    
    $mess = array(
    "message" => "Product was created",
    );
    
    echo json_encode($mess);
  }
  else {
    http_response_code(503);
    
    $mess = array(
    "message" => "Unable to create product",
    );
    
    echo json_encode($mess);
  }
}
else {
  http_response_code(400);
  
  $mess = array(
  "message" => "Unable to create product. Data is incomplete.",
  );
  
  echo json_encode($mess);
}

?>