<?php
session_start();
  header("Content-Type: application/json");
  require_once(__DIR__."/../../config/connection.php");
  require_once(__DIR__."/functions.php");

if(isset($_POST['_category_id'])){

    $cat_id = $_POST['_category_id'];

    try{
      // require_once(CFUNCTIONS);
      $cat_name = getCategoryById($cat_id);
      $cat_name_full = $cat_name -> name;


      deleteCategoryById($cat_id);

      // $folder = ROOT."assets/images/".$cat_name_full;
      // $files = glob($folder.'/*');
      // foreach($files as $file)
      // {
      //   if(is_file($file))
      //   {
      //     unlink($file);
      //   }
      // }
      // rmdir(ROOT."assets/images/".$cat_name_full);
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
