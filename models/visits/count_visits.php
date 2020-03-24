<?php
session_start();
header('Content-Type: application/json');
require_once(__DIR__."/../../config/connection.php");



if($_SERVER['REQUEST_METHOD'] === 'POST')
{
  try
  {
    $_page = $_POST['_page'];


    $user_file = @ fopen (__DIR__."/../../data/log.txt", "a");

      if($user_file)
      {
        $date = date("d/F/Y H:i:s");
        $data = (isset($_SESSION['user']) ? $_SESSION['user'] -> username : "Guest") . "\t" . $_page . "\t" . $_SERVER["REMOTE_ADDR"] . "\t" . $date . "\t\n";

        fwrite($user_file, $data);
        fclose($user_file);
      }

      // prikaz u tabeli


      // $counter = 1;
      $countAll = 0;

      $count_index = 0;
      $count_about = 0;
      $count_shop = 0;
      $count_contact = 0;

      $file = @ fopen (__DIR__."/../../data/log.txt", "r");


      if($file)
      {
        $data = file (__DIR__."/../../data/log.txt");
        fclose($file);
        // $array_pages = ['home', 'about', 'shop', 'contact'];
        foreach($data as $d)
        {
          $single_row = explode("\t", $d);
          $page = trim($single_row[1]);

          switch($page)
          {
            case 'home': $count_index++;$countAll++;
              break;
            case 'about': $count_about++;$countAll++;
              break;
            case 'shop': $count_shop++;$countAll++;
              break;
            case 'contact': $count_contact++;$countAll++;
              break;
          }
        }
      }

      $date = date("d/F/Y");
      $file = @ fopen (__DIR__."/../../data/log.txt", "r");

      $counter_index_today = 0;
      $counter_about_today = 0;
      $counter_shop_today = 0;
      $counter_contact_today = 0;

      if($file)
      {
        $data = file (__DIR__."/../../data/log.txt");
        fclose($file);
        foreach($data as $d)
        {
          $single_row = explode("\t", $d);
          $page = trim($single_row[1]);
          $pageDate = trim($single_row[3]);
          $just_date = explode(" ", $pageDate)[0];

          if($just_date == $date)
          {
            switch($page)
            {
              case 'home': $counter_index_today++;
                break;
              case 'about': $counter_about_today++;
                break;
              case 'shop': $counter_shop_today++;
                break;
              case 'contact': $counter_contact_today++;
                break;
            }
          }
        }



      }

      echo json_encode([
        'count_index' => $count_index,
        'count_about' => $count_about,
        'count_shop' => $count_shop,
        'count_contact' => $count_contact,
        'countAll' => $countAll,
        'counter_index_today' => $counter_index_today,
        'counter_about_today' => $counter_about_today,
        'counter_shop_today' => $counter_shop_today,
        'counter_contact_today' => $counter_contact_today

      ]);





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
