<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function reset_mail($email, $name, $vcode){

//Load Composer's autoloader
require 'autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = false;  //SMTP::DEBUG_SERVER                     //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'photosthapit10@gmail.com';                     //SMTP username
    $mail->Password   = 'kealdjmajknrsdlw';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('photosthapit10@gmail.com', 'Reliance LMS');
    $mail->addAddress($email, $name);     //Add a recipient
    // $mail->addReplyTo('photosthapit10@gmail.com', 'Reliance LMSSSS');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Verification Code';
    $mail->Body    = "<p style='font-size:20px;margin-bottom:3px;'>Hi, $name</p>
    <p style='margin-bottom:3px;'>Use this code to reset ur password</p>
    <span style='color:red;font-size:40px;background-color:black;padding:10px 20px;border-radius:13px;'>$vcode</span><br>
    <p style='margin-top:50px;font-size:30px;margin-bottom:0px;'>Thank you</p>
    <p style='font-size:20px;margin-top:0px; margin-bottom:5px;'>Regards,</p>
    <p>Reliance LMS, Team</p>
    ";
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    // echo 'Message has been sent';
} catch (Exception $e) {
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}