<?php
session_start();
  header("Content-Type: application/json");
  require_once(__DIR__."/../../config/connection.php");
  require_once(__DIR__."/functions.php");

if(isset($_POST['_id'])){
    $cat_id = $_POST['_id'];

    try{
      $category = getCategoryById($cat_id);
      echo json_encode($category);
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
