<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = 2;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'sandbox.smtp.mailtrap.io   ';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'c86206bb7d48bc';                     //SMTP username
    $mail->Password   = '0222a23f95f47c';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($email);
    $mail->addAddress('aini9900933850@gmail.com ', 'Khurotul Aini Husna');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'New Job Application ';
    $mail->Body    = 'A new job application has been submitted:\n\n';
    $mail->Body    = 'Job Position: ($job-pos\n';
    $mail->Body    = 'Full Name: $name\n';
    $mail->Body    = 'Email: $email\n';
    $mail->Body    = 'Phone Number: $phone\n';
    $mail->Body    = 'Message:\n$message\n';
    $mail->Body    = 'Qualification:\n$qualification\n';
    $mail->Body    = 'Experience:\n$experience\n';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    //Attachments
    $mail->addAttachment($fileattch);         //Add attachments

    $mail->send($submit);
    echo 'Application has been submitted successfully';
} catch (Exception $e) {
    echo "An error occurred while sending the email: {$mail->ErrorInfo}";
}
?>