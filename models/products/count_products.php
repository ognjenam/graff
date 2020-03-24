<?php
session_start();
  header("Content-Type: application/json");
  require_once(__DIR__."/../../config/connection.php");
  require_once(__DIR__."/functions.php");
  if($_SERVER['REQUEST_METHOD'] === 'POST')
  {
    try{
      $links_pagination = countProducts();
      $sum = $links_pagination -> total;
      $links = ceil($sum / 4);

      echo json_encode($links);
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
