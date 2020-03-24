<?php
session_start();
  header("Content-Type: application/json");
  require_once(__DIR__."/../../config/connection.php");
  require_once(__DIR__."/functions.php");


if(isset($_GET['_id'])){
    try{
      $prod_id = $_GET['_id'];
      $products = filterProductModal($prod_id);
      echo json_encode($products);
    }

    catch(PDOException $e)
    {
      require_once(__DIR__."/../files/functions.php");
      catchErrors($e -> getMessage());
      http_response_code(500);


    }
}
else {
  http_response_code(400);
}
