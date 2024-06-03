<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailerAutoload.php file  
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output (set to 2 for detailed debugging)
    $mail->isSMTP();                           // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';          // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                    // Enable SMTP authentication
    $mail->Username = 'forwardlinkage2024@gmail.com'; // SMTP username
    $mail->Password = 'fxxhqiyugwgvaqqv';   // SMTP password
    $mail->SMTPSecure = 'ssl';                 // Enable TLS encryption, 'ssl' also accepted
    $mail->Port = 465;                         // TCP port to connect to

    // Sender and recipient settings
    $mail->setFrom('forwardlinkage2024@gmail.com', 'Your Name');
    $mail->addAddress('jithuvudayan02487@gmail.com', 'jithu');

    // Email content
    $mail->isHTML(true);   // Set email format to HTML
    $mail->Subject = 'Subject of the email';
    $mail->Body    = 'This is the HTML message body';
    $mail->AltBody = 'This is the plain text version of the email';

    // Send email
    $mail->send();
    echo 'Email has been sent.';
} catch (Exception $e) {
    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
