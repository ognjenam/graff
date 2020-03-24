<?php
session_start();
header("Content-Type: application/json");


if(isset($_POST['_category_name']) && isset($_POST['_category_id'])){

  $cat_name = $_POST['_category_name'];
  $cat_id = $_POST['_category_id'];

  $reName = "/^[A-z]{2,}(\s([A-z]{2,}))*$/";

  if(preg_match($reName, $cat_name))
  {
    try{
      require_once(__DIR__."/../../config/connection.php");
      require_once(__DIR__."/functions.php");

      // rename(ROOT."assets/images/".$cat_name, )
      updateNameCategory($cat_name, $cat_id);

      // $new_cat_name = getCategoryById($cat_id) -> name;
      // $old_name = $_SERVER['DOCUMENT_ROOT'].'/assets/images/'.$cat_name;
      // $new_name = $_SERVER['DOCUMENT_ROOT'].'/assets/images/'.$new_cat_name;
      // $root=$_SERVER['DOCUMENT_ROOT'];

      //rename("$root/assets/images/$cat_name", "$root/assets/images/$new_cat_name");





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
