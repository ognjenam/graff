<?php
session_start();
  header("Content-Type: application/json");


if(isset($_POST['_name'])){
    $cat_name = $_POST['_name'];

    $reName = "/^[A-z]{2,}(\s([A-z]{2,}))*$/";

    if(preg_match($reName, $cat_name))
    {
      try{
        require_once(__DIR__."/../../config/connection.php");
        require_once(__DIR__."/functions.php");

        addCategory($cat_name);
        // mkdir(ROOT."assets/images/added_categories/");
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
