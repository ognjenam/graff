<?php
require_once(__DIR__."/config.php");
  try{
    $conn = new PDO("mysql:host=".LOCALHOST.";dbname=".DBNAME.";charset=utf8", USERNAME, PASSWORD);
    $conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $conn -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
  }


  catch(PDOExceptio $e)
  {
    echo $e -> getMessage();
  }

  function queryExecute($query)
  {
    global $conn;
    return $conn -> query($query) -> fetchAll();
  }

  counter();



  function counter()
  {
    // ukupno poseta kroz DB
    global $conn;
    $queryVisits = "UPDATE visits SET number = number + 1";
    $result = $conn -> query($queryVisits);

  }
