<?php

use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

function sendMail($subject, $body, $email, $name, $html = false) {

    //Server settings
    $phpmailer = new PHPMailer();
    $phpmailer->isSMTP();
    $phpmailer->Host = $_ENV['MAIL_HOST'];
    $phpmailer->SMTPAuth = true;
    $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $phpmailer->Port = $_ENV['MAIL_PORT'];
    $phpmailer->Username = $_ENV['MAIL_USERNAME'];
    $phpmailer->Password = $_ENV['MAIL_PASSWORD'];

    //Recipients
    $phpmailer->setFrom($_ENV['MAIL_FROM'], $_ENV['MAIL_FROM_TEXT']);
    $phpmailer->addAddress($email, $name);     //Add a recipient
    //$phpmailer->addAddress('ellen@example.com');               //Name is optional
    //$phpmailer->addReplyTo('info@example.com', 'Information');
    //$phpmailer->addCC('cc@example.com');
    //$phpmailer->addBCC('bcc@example.com');

    //Content
    $phpmailer->isHTML($html);  //Set email format to HTML
    $phpmailer->Subject = $subject;
    $phpmailer->Body    = $body;
    $phpmailer->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $phpmailer->send();

}