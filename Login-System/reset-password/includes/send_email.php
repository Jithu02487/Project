<html>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../assets/setup/env.php';
// require 'C:\xampp\htdocs\mini project\Login-System\reset-password\vendor\autoload.php'; // Include PHPMailer
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $gmail=$_POST['email'];
    echo $gmail;
    // Create a PHPMailer instance
    $mail = new PHPMailer(true); // Set 'true' to enable exceptions

    try {
        // SMTP server configuration (e.g., for Gmail)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'jithuvudayan02487@gmail.com';
        $mail->Password = 'foqcjjhqygpqibgc';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use 'tls' or 'ssl' if required
        $mail->Port = 587;

        // Sender and recipient settings
        $mail->setFrom('jithuvudayan02487@gmail.com', 'Luzifer');
        $mail->addAddress('jithuvudayan02487@gmail.com');

        // Email subject and body
        $mail->Subject = "Password Resetting link";
        $mail->Body = "This is body";

        // Send the email
        $mail->send();
        echo 'Message has been sent successfully';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
</html>