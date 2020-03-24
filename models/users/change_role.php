<?php
session_start();
header("Content-Type: application/json");


if(isset($_POST['_user_id']) && isset($_POST['_role_name'])){

  $user_id = $_POST['_user_id'];
  $role_val = $_POST['_role_name'];


  if($role_val == 'admin' || $role_val == 'user')
  {
    try{
      require_once(__DIR__."/../../config/connection.php");
      require_once(__DIR__."/functions.php");

      $role_id = getRoleId($role_val);

      $value = $role_id -> role_ID;


      updateUserRole((int)$value, $user_id);
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
    echo json_encode(['roleError' => 'admin / user']);
    exit();
  }


}

else {
  http_response_code(400);
}
