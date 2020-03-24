<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once(__DIR__."/../../config/connection.php");
require_once(__DIR__.'/vendor/autoload.php');

function sendContactMail($to, $content){



$mail = new PHPMailer(true);   // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'graffonlineshop@gmail.com';                 // SMTP username
    $mail->Password = 'volimkk98';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('graffonlineshop@gmail.com', 'Graff Contact Form');
    $mail->addAddress('graffonlineshop@gmail.com');     // Add a recipient
    $mail->addReplyTo($to, 'Information: ');


    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Graff Shop Contact Form';
    $mail->Body    = $content;

    $mail->send();
    // echo 'Message has been sent!';
    return true;
} catch (Exception $e) {
    // echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    return false;
}
}
