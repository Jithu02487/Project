<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor\phpmailer\phpmailer\src\Exception.php';
    require 'vendor\phpmailer\phpmailer\src\PHPMailer.php';
    require 'vendor\phpmailer\phpmailer\src\SMTP.php';
    include '..\..\assets\setup\env.php';
    require '../../assets/setup/db.inc.php';

    session_start();
    $to=$_SESSION['email'];
    $otp = sprintf('%06d', random_int(100000, 999999));
    $subject = 'varification';
    $mail_variables = array();

    $mail_variables['APP_NAME'] = APP_NAME;
    $mail_variables['OTP'] = $otp;

    $message = file_get_contents("./vendor/mail_templet.php");

    foreach($mail_variables as $key => $value) {
        
        $message = str_replace('{{ '.$key.' }}', $value, $message);
    }

    $mail = new PHPMailer(true);

    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host = MAIL_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = MAIL_USERNAME;
        $mail->Password = MAIL_PASSWORD;
        
        $mail->SMTPSecure = MAIL_ENCRYPTION;
        $mail->Port = MAIL_PORT;

        $mail->setFrom(MAIL_USERNAME, APP_NAME);
        $mail->addAddress($to, APP_NAME);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        // Assuming $mysqli is your MySQLi connection
        $hashedOtp = md5($otp);
        $expirationTime = date('Y-m-d H:i:s', strtotime('+180 seconds'));
        $sql = "INSERT INTO otp (otp, email, created_at, expires_at) VALUES (?, ?, NOW(), ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            // Handle the error, for example:
            die('Error preparing statement: ' . $conn->error);
        }

        $bindResult = $stmt->bind_param("sss", $hashedOtp,$to,$expirationTime);
        if ($bindResult === false) {
            // Handle the error, for example:
            die('Error binding parameters: ' . $stmt->error);
        }

        $executeResult = $stmt->execute();
        if ($executeResult === false) {
            // Handle the error, for example:
            die('Error executing statement: ' . $stmt->error);
            
        }
        header("Location: vendor/otpvalidate.php");
        exit();
    } 
    catch (Exception $e) {

        // for public use
        // $_SESSION['STATUS']['mailstatus'] = 'message could not be sent, try again later';

        // for development use
        $_SESSION['STATUS']['mailstatus'] = 'message could not be sent. ERROR: ' . $mail->ErrorInfo;

        header("Location: vendor/otpvalidate.php");
        exit();
    }



?>