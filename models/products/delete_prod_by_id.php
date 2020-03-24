<?php
session_start();
  header("Content-Type: application/json");
  require_once(__DIR__."/../../config/connection.php");



if(isset($_POST['_prod_id'])){

    $prod_id = $_POST['_prod_id'];

    try{
      require_once(__DIR__."/functions.php");
      // $cat_name_by_id = categoryByProduct($prod_id);
      // $name_cat = $cat_name_by_id -> catName;
      //
      // $folder = ROOT."assets/images/".$name_cat;
      $img_path = allAboutProduct($prod_id);
      unlink(__DIR__."/../../assets/" . $img_path -> image);
      unlink(__DIR__."/../../assets/" . $img_path -> image_big);


      deleteProduct($prod_id);
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
  http_response_code(400);
}
