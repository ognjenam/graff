<?php
session_start();
header("Content-Type: application/json");
require_once(__DIR__."/../../config/connection.php");
require_once(__DIR__."/functions.php");

if(isset($_POST['_email']) && isset($_POST['_password']))
{
  $email = $_POST['_email'];
  $password = md5($_POST['_password']);

  // var_dump($password);

  $regEmail = "/^[A-z\d]{2,}(\.?(\W\D)?[A-z\d]{2,})*\@\w{2,}(\.\w{2,})*$/";
  $regPassword = "/([\w\W\D\d]){7,}/";

  $errorEmail = "";
  $errorPassword = "";

  $flag = 0;

  if(!preg_match($regEmail, $email))
  {
    $flag++;
    $errorEmail .= "xx (. xx) @ xx . xx (. xx)";
  }

  if(!preg_match($regPassword, $password))
  {
    $flag++;
    $errorPassword .= "at least 7 characters";
  }

  if($flag > 0)
  {
    echo json_encode(['errorEmail' => $errorEmail, 'errorPassword' => $errorPassword]);
    exit;
  }

  else if($flag == 0){
    $userEmail =  userByEmail($email);

    if($userEmail == false)
    {
      $errorEmail .= "E-mail doesn't exists!";

      echo json_encode(['errorEmail' => $errorEmail]);
      exit;
    }

    else if($userEmail == true)
    {
      $pass = userByEmail($email);


      if($password != $pass -> password)
      {
        $errorPassword .= "Password doesn't match!";
        loginError($pass -> user_ID);
        $loginErrorCount = counterError($pass -> user_ID);
        $user_num_err = $loginErrorCount -> log_error;
        $username_by_id = userNameById($pass -> user_ID);
        $username_ = $username_by_id -> username;
        $str = 10;

        if($user_num_err == 3)
        {
          require_once(__DIR__."/../phpmailer/mailerPassGenerator.php");
          $rand = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$str);
          $message = "Dear $username_, Your new password is: " . $rand;
          $errorPassword = "Password is changed! Please check your e-mail.";
          echo json_encode(['newPassword' => $errorPassword]);
          $result = sendContactMail($userEmail -> e_mail, $message);
          changedPass($rand,$pass -> user_ID);
          updateErrorPass($pass -> user_ID);
          exit;
        }

        echo json_encode(['errorPassword' => $errorPassword]);
        exit;
      }
      else {

        $result = userByEmailAndPass($email, $password);

        $result_ = $result -> fetch();
        if($result -> rowCount() == 1)
        {

          $user = $result_;
          $_SESSION['user'] = $user;
          $_SESSION['user_id'] = $user -> user_ID;
          $_SESSION['user_role'] = $user -> role_ID;

          $date = date("Y-m-d H:i:s");

          $update = lastVisit($date, $_SESSION['user_id']);


          if($_SESSION['user_role'] == 1)
          {
            echo json_encode(['admin' => 1]);
            exit;
          }
          else if($_SESSION['user_role'] == 2)
          {
            echo json_encode(['user' => 2]);
            exit;
          }




        }






      }
    }


  }
}
