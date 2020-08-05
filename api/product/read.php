<?php

header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");

require_once ("../config/database.php");
require_once ("../objects/product.php");

$database = new Database();
$db = $database->open_link();

$product = new Product(string $db);

$stmt = $product->read();

?>