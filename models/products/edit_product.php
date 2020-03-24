<?php
session_start();
header("Content-Type: application/json");


if(isset($_POST['_product_name']) && isset($_POST['_product_id'])){

  $prod_name = $_POST['_product_name'];
  $prod_id = $_POST['_product_id'];

  $reName = "/^[A-z]{2,}(\s([A-z]{2,}))*$/";

  if(preg_match($reName, $prod_name))
  {
    try{

      require_once(__DIR__."/../../config/connection.php");
      require_once(__DIR__."/functions.php");

      updateNameProduct($prod_name, $prod_id);
      echo json_encode(true);
    }
    catch(PDOException $e)
    {
      require_once(__DIR__."/../files/functions.php");
      catchErrors($e -> getMessage());
      http_response_code(500);
    }
  }

  else {
    echo json_encode(['nameHint' => 'A-z']);
    exit();
  }


}

else {
  http_response_code(400);
}
