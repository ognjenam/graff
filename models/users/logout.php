<?php
session_start();
require_once(__DIR__."/../../config/connection.php");
require_once(__DIR__."/functions.php");

if(isset($_SESSION['user']))
  {
    $user_id = $_SESSION['user'] -> user_ID;
    $logout = logout($user_id);

    unset($_SESSION['user']);
    session_destroy();
  }
  header('Location: ../../index.php');
