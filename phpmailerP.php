<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../hospital/vendor/autoload.php';


$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPDebug = SMTP::DEBUG_OFF;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->SMTPAuth = true;
$mail->Username = '17031200@itcelaya.edu.mx';
$mail->Password = 'Chaparro98';
$mail->setFrom('17031200@itcelaya.edu.mx', 'Pablo Cid');
$mail->addReplyTo('17031200@itcelaya.edu.mx', 'Pablo Cid');
$mail->addAddress('pablocidsoto@hotmail.com', 'Pablo Cid');
$mail->Subject = 'PHPMailer GMail SMTP test';
$mail->msgHTML('Hola mundo');
$mail->AltBody = 'This is a plain-text message body';
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';    
}

