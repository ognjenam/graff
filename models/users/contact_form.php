<?php
header('Content-Type: application/json');
session_start();
require_once(__DIR__."/../../config/connection.php");
require_once(__DIR__."/../phpmailer/contactMailer.php");

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $name = $_POST['_name'];
  $message = $_POST['_message'];
  $email = $_POST['_email'];
  $subject= $_POST['_subject'];

  $reName = "/^[A-Z][a-z]{1,}(\s[A-Z][a-z]{1,})*$/";
  $reSubject = "/^[A-z]{2,}(\s[A-z]{3,})*$/";
  $reMessage = "/^[A-z]{2,}(\W\D\d\s)*/";
  $reEmail = "/^[A-z\d]{2,}(\.?(\W\D)?[A-z\d]{2,})*\@\w{2,}(\.\w{2,})(\.\w{2,})*$/";

  $error = 0;
  $errorName = "";
  $errorSubject = "";
  $errorMessage = "";
  $errorEmail = "";



  if(!preg_match($reName, $name))
  {
    $error++;
    $errorName .= "A-z (at least 2 letters)";
  }
  else {
    $errorName .= "";
  }
  if(!preg_match($reSubject, $subject))
  {
    $error++;
    $errorSubject .= "A-z (at least 2 letters)";
  }
  else {
    $errorSubject .= "";
  }
  if(!preg_match($reMessage, $message))
  {
    $error++;
    $errorMessage .= "Start at least with 2 letters...";
  }
  else {
    $errorMessage .= "";
  }
  if(!preg_match($reEmail, $email))
  {
    $error++;
    $errorEmail .= "xx (. xx) @ xx . xx (. xx)";
  }
  else {
    $errorEmail .= "";
  }
  if($error > 0)
  {
    echo json_encode(["errorName" => $errorName, "errorMessage" => $errorMessage, "errorSubject" => $errorSubject, "errorEmail" => $errorEmail]);
    exit;
  }

  else if($error == 0)
  {
    $result = sendContactMail($email, $message);
    $result ? $response = 'Message has been sent!' :  $response = 'Message has not been sent!';
    echo json_encode(['response' => $response]);
  }

}
