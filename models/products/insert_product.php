<?php
session_start();
header("Content-Type: application/json");
require_once(__DIR__."/../../config/connection.php");
require_once(__DIR__."/functions.php");
require_once(__DIR__."/../categories/functions.php");

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $_name = $_POST['_name'];
    $_descr = $_POST['_descr'];
    $_price= $_POST['_price'];
    $_old_price = $_POST['_old_price'];
    $_color= $_POST['_color'];


    if(isset($_POST['_category']))
    {
      $_category_id = $_POST['_category'];

      $cat_name_by_id = getCategoryById($_category_id);
      var_dump($cat_name_by_id -> name);
      // $full_cat_name = $cat_name_by_id['name'];
    }


    if($_old_price == "")
    {
      $_old_price = NULL;
    }
    $reName = "/^[A-z]{2,}(\s([A-z]{2,}))*$/";
    $reDescr= "/[\w\d\W\D]/";
    $rePrice = "/^[1-9]{1}[0-9]{1,}\.[0-9][0-9]$/";
    $reOldPrice = "/^([1-9]{1}[0-9]{1,}\.[0-9][0-9])?$/";

    $image_allowed_ext = ["image/jpeg", "image/jpg", "image/png"];



    $flag = 0;
    $errorName = "";
    $errorDescr = "";
    $errorColor = "";
    $errorPrice = "";
    $errorOldPrice = "";
    $errorBigImage = "";
    $errorSmallImage = "";
    $errorCat = "";


    if($_category_id == "undefined")
    {
      $flag++;
      $errorCat .= "Please choose...";
    }

    if(!preg_match($reName, $_name))
    {
      $flag++;
      $errorName .= "A-z";
    }
    if(!preg_match($reDescr, $_descr))
    {
      $flag++;
      $errorDescr .= "(words, numbers, special symbols)";
    }
    if(!preg_match($reName, $_color))
    {
      $flag++;
      $errorColor .= "A-z";
    }
    if(!preg_match($rePrice, $_price))
    {
      $flag++;
      $errorPrice .= "nn.nn";
    }

    if($_old_price != "")
    {
      if(!preg_match($reOldPrice, $_old_price))
      {
        $flag++;
        $errorOldPrice .= "nn.nn";
      }
    }


    // big image
    if(!isset($_FILES['big_image']))
    {
      $flag++;
      $errorBigImage .= "Choose cover image...";
    }


    else if(isset($_FILES['big_image']))
    {
      $big_img_type = $_FILES['big_image']['type'];
      $big_img_size = $_FILES['big_image']['size'];
      // var_dump($big_img_size);
      if(!in_array($big_img_type, $image_allowed_ext))
      {
        $flag++;
        $errorBigImage .= "JPG, JPEG, PNG";
      }

      if($big_img_size > 2097152)
      {
        $flag++;
        $errorBigImage .= "Upload smaller image!";
      }



      else {
        // <resize>

        $big_img_name = $_FILES['big_image']['name'];
        $big_img_size = getimagesize($_FILES['big_image']['tmp_name']);
        $big_image_tmp = $_FILES['big_image']['tmp_name'];

        list($old_w, $old_h) = getimagesize($big_image_tmp);

        $width = 400;
        $height = ($width / $old_w) * $old_h;

        if($big_img_type == "image/jpg"){ $blank = imagecreatefromjpeg($big_image_tmp);}
        else if($big_img_type == "image/jpeg"){ $blank = imagecreatefromjpeg($big_image_tmp);}
        else if($big_img_type == "image/png"){ $blank = imagecreatefrompng($big_image_tmp);}

        $empty_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($empty_image, $blank, 0, 0, 0, 0, $width, $height, $old_w, $old_h);

        $new_big_image = $empty_image;



        if($cat_name_by_id -> name != 'Bracelets' && $cat_name_by_id -> name != 'Earrings' && $cat_name_by_id -> name != 'Necklaces' && $cat_name_by_id -> name != 'Rings')
        $dir = __DIR__."/../../assets/images/added_categories/";

        else {
          $dir = __DIR__."/../../assets/images/" . strtolower($cat_name_by_id -> name) . "/";
        }
        $big_img_name = $dir . round(microtime() * 1000) . $_FILES['big_image']['name'];



        if($big_img_type == "image/jpg"){ imagejpeg($new_big_image, $big_img_name, 100);}
        else if($big_img_type == "image/jpeg"){ imagejpeg($new_big_image, $big_img_name, 100);}
        else if($big_img_type == "image/png"){ imagepng($new_big_image, $big_img_name, 100);}

        $db_big_img_name_expl = explode("/", $big_img_name);
        var_dump($db_big_img_name_expl);
        $db_big_img_name = "images/".$db_big_img_name_expl[5] . "/" . $db_big_img_name_expl[6];


        // </resize>


      }
    }
    // small image
    if(!isset($_FILES['small_image']))
    {
      $flag++;
      $errorSmallImage .= "Choose small image...";
    }


    else if(isset($_FILES['small_image']))
    {
      $small_img_type = $_FILES['small_image']['type'];
      $small_img_size = $_FILES['small_image']['size'];
      if(!in_array($small_img_type, $image_allowed_ext))
      {
        $flag++;
        $errorSmallImage .= "JPG, JPEG, PNG";
      }
      if($small_img_size > 2097152)
      {
        $flag++;
        $errorSmallImage .= "Upload smaller image!";
      }

      else {
        // <resize>

        $small_img_name = $_FILES['small_image']['name'];
        $small_img_size = getimagesize($_FILES['small_image']['tmp_name']);
        $small_image_tmp = $_FILES['small_image']['tmp_name'];

        list($old_w, $old_h) = getimagesize($small_image_tmp);

        $width = 200;
        $height = ($width / $old_w) * $old_h;

        if($small_img_type == "image/jpg"){ $blank = imagecreatefromjpeg($small_image_tmp);}
        else if($small_img_type == "image/jpeg"){ $blank = imagecreatefromjpeg($small_image_tmp);}
        else if($small_img_type == "image/png"){ $blank = imagecreatefrompng($small_image_tmp);}

        $empty_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($empty_image, $blank, 0, 0, 0, 0, $width, $height, $old_w, $old_h);

        $new_small_image = $empty_image;

        if($cat_name_by_id -> name != 'Bracelets' && $cat_name_by_id -> name != 'Earrings' && $cat_name_by_id -> name != 'Necklaces' && $cat_name_by_id -> name != 'Rings')
        $dir = __DIR__."/../../assets/images/added_categories/";

        else {
          $dir = __DIR__."/../../assets/images/" . strtolower($cat_name_by_id -> name) . "/";
        }
        $small_img_name = $dir . round(microtime() * 1000) . $_FILES['small_image']['name'];

        if($small_img_type == "image/jpg"){ imagejpeg($new_small_image, $small_img_name, 100);}
        else if($small_img_type == "image/jpeg"){ imagejpeg($new_small_image, $small_img_name, 100);}
        else if($small_img_type == "image/png"){ imagepng($new_small_image, $small_img_name, 100);}

        $db_small_img_name_expl = explode("/", $small_img_name);
        $db_small_img_name = "images/".$db_small_img_name_expl[5] . "/" . $db_small_img_name_expl[6];

        // </resize>


      }
    }

    if($flag > 0)
    {
      echo json_encode(['errorName' => $errorName, 'errorDescr' => $errorDescr, 'errorColor' => $errorColor,
      'errorPrice' => $errorPrice, 'errorOldPrice' => $errorOldPrice,
      'errorBigImage' => $errorBigImage, 'errorSmallImage' => $errorSmallImage, 'errorCat' => $errorCat]);
      exit();
    }

    else if($flag == 0)
    {
      try{
        $insert = insertProduct($_name, $_price, $_old_price, $_color, $db_small_img_name, $db_big_img_name, $_descr, $_category_id);
        echo json_encode(true);

      }
      catch(PDOException $e){
        require_once(__DIR__."/../files/functions.php");
        catchErrors($e -> getMessage());
        http_response_code(500);
      }
    }

}

else {
  http_response_code(400);
}
