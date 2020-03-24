<?php
ob_start();
session_start();
  require_once(__DIR__."/config/connection.php");

  require_once(__DIR__."/views/fixed/head.php");
  require_once(__DIR__."/views/fixed/main_menu.php");
  require_once(__DIR__."/views/fixed/slider.php");

  if(!isset($_SESSION['user'])){

    require_once(__DIR__."/views/login_register.php");
}
    else if(isset($_SESSION['user'])){

      require_once(__DIR__."/views/cart_panel.php");



    if($_SESSION['user_role'] == 1){


        if(isset($_GET['page']))
        {
          switch($_GET['page'])
          {
            case 'file':
              if(isset($_GET['id']))
              {
                 if($_GET['id'] == 0)
                {
                  require_once(__DIR__."/models/files/word_file.php");
                  // header("Location: models/files/word_file.php");
                }
                else if($_GET['id'] == 1)
                {
                  header("Location: models/files/excel_file.php");
                }
                else {
                  header("Location: views/404.php");
                }


              }
              else {
                header("Location: views/404.php");
              }
              break;
            default:
                header("Location: views/404.php");
              break;

          }
        }

        else {
          require_once(__DIR__."/views/adminPanel.php");
        }





    }
  }


  require_once(__DIR__."/views/fixed/products.php");



  require_once(__DIR__."/views/fixed/footer.php"); ?>
