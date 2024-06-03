<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../assets/setup/env.php';
require '../../assets/setup/db.inc.php';



    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    $url = "localhost/mini%20project/Login-System/verify/includes/verify.inc.php?selector=" . $selector . "validator=" . bin2hex($token);
    $expires = 'DATE_ADD(NOW(), INTERVAL 1 HOUR)';
    $sql = "DELETE FROM auth_tokens WHERE user_email=? AND auth_type='account_verify';";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {

        $_SESSION['ERRORS']['sqlerror'] = 'SQL ERROR';
        header("Location: ../");
        exit();
    }
    else {

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
    }


    $sql = "INSERT INTO auth_tokens (user_email, auth_type, selector, token, expires_at) 
            VALUES (?, 'account_verify', ?, ?, " . $expires . ");";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {

        $_SESSION['ERRORS']['sqlerror'] = 'SQL ERROR';
        header("Location: ../");
        exit();
    }
    else {
        
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "sss", $email, $selector, $hashedToken);
        mysqli_stmt_execute($stmt);
    }


    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    $to = $email;
    $subject = 'Verify Your Account';
    
    /*
    * -------------------------------------------------------------------------------
    *   Using email template
    * -------------------------------------------------------------------------------
    */
    $mail = new PHPMailer(true); 

    $mail_variables = array();

    $mail_variables['APP_NAME'] = APP_NAME;
    $mail_variables['username'] = $username;
    $mail_variables['email'] = $email;
    $mail_variables['url'] = $url;

    $message = file_get_contents("./template_verificationemail.php");

    foreach($mail_variables as $key => $value) {
        
        $message = str_replace('{{ '.$key.' }}', $value, $message);
    }

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
         $mail->Subject = $subject;
         $mail->Body = $message;
 
         // Send the email
         $mail->send();
         $_SESSION['STATUS']['loginstatus'] = 'Account Created and Password send through the mail';
         header("Location: ../");
         exit();
    } 
    catch (Exception $e) {
        $_SESSION['ERRORS']['mailerror'] = $e->getMessage();
        
    }