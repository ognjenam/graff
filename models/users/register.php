<?php
  session_start();
  header("Content-Type: application/json");
  require_once(__DIR__."/../../config/connection.php");
  require_once(__DIR__."/functions.php");

  if(isset($_POST['_username']) && isset($_POST['_email']) && isset($_POST['_password']))
  {
    $username = $_POST['_username'];
    $email = $_POST['_email'];
    $password = $_POST['_password'];
    $message = "";
    $flag = 0;
    $inserted = 0;

    $errorUsername = "";
    $errorEmail = "";
    $errorPassword = "";

    // da li postoji username
    $userUsername =  userByUsername($username);

    if($userUsername)
    {
      $flag++;
      $errorUsername .= "Username already exists!";
    }

    // da li postoji e-mail
    $userEmail =  userByEmail($email);

    if($userEmail)
    {
      $flag++;
      $errorEmail .= "E-mail already exists!";
    }

    // ispisivanje greske
    if($flag > 0)
    {
      echo json_encode(['errorUsername' => $errorUsername, 'errorEmail' => $errorEmail]);
      exit;
    }

    // ako nema korisnika radi se registracija
    else if($flag == 0)
    {

      $regUsername = "/^[a-z]{3,8}(\_[a-z]{0,8})*$/";
      $regEmail = "/^[A-z\d]{2,}(\.?(\W\D)?[A-z\d]{2,})*\@\w{2,}(\.\w{2,})*$/";
      // $regPassword = "/[a-z]{5,}[0-9]{2,}(\W\D)*/";
      $regPassword = "/([\w\W\D\d]){7,}/";


      if(!preg_match($regUsername, $username))
      {
        $flag++;
        $errorUsername .= "begin with letters (3-8 characters), underscore";
      }

      if(!preg_match($regEmail, $email))
      {
        $flag++;
        $errorEmail .= "xx (. xx) @ xx (. xx)";
      }

      if(!preg_match($regPassword, $password))
      {
        $flag++;
        $errorPassword .= "at least 7 characters";
      }

      if($flag > 0)
      {
        echo json_encode(['errorUsername' => $errorUsername, 'errorEmail' => $errorEmail, 'errorPassword' => $errorPassword]);
        exit;
      }

      else if($flag == 0)
      {
        $queryNewUser = addNewUser($username, $email, $password);

        $lastUser = $conn -> lastInsertId();

        $inserted = 1;

        http_response_code(201);
        echo json_encode(['inserted' => $inserted]);
        exit;
      }
    }
  }
