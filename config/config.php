<?php
// define("ROOT", __DIR__."/");
// define("LOCAL_MACHINE", "http://127.0.0.1/graff/");

define("USERNAME", env("USERNAME"));
define("PASSWORD", env("PASSWORD"));
define("LOCALHOST", env("LOCALHOST"));
define("DBNAME", env("DBNAME"));

define("PFUNCTIONS", __DIR__."../models/products/functions.php");
define("CFUNCTIONS", __DIR__."../models/categories/functions.php");
define("UFUNCTIONS", __DIR__."../models/users/functions.php");
define("FFUNCTIONS", __DIR__."../models/files/functions.php");

function env($string)
{
  $envFile = fopen(__DIR__."/.env", "r");
  $envResult = file(__DIR__."/.env");
  fclose($envFile);

  foreach($envResult as $key => $val)
  {
    $singleEnv = explode('=', $val);
    if($string == $singleEnv[0])
    {
      $result = trim($singleEnv[1]);
    }
  }
  return $result;
}
