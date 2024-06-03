<?php



session_start();



require '../../assets/setup/env.php';

require '../../assets/setup/db.inc.php';



use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;



require '../../assets/vendor/PHPMailer/src/Exception.php';

require '../../assets/vendor/PHPMailer/src/PHPMailer.php';

require '../../assets/vendor/PHPMailer/src/SMTP.php';



   

    /*

    * -------------------------------------------------------------------------------

    *   Verifying CSRF token

    * -------------------------------------------------------------------------------

    */



    $email=$_SESSION['mail'];

    $username=$_SESSION['name'];

    $to = $email;

    $password=$_SESSION['password'];

    $subject = ' Password';

    $url="http://localhost/Forward%20linkage/Login-System/login/";

    

    /*

    * -------------------------------------------------------------------------------

    *   Using email template

    * -------------------------------------------------------------------------------

    */



    $mail_variables = array();



    $mail_variables['APP_NAME'] = APP_NAME;

    $mail_variables['username'] = $username;

    $mail_variables['password'] = $password;

    $mail_variables['email'] = $email;

    $mail_variables['url'] = $url;



    $message = file_get_contents("./template_verificationemail.php");



    foreach($mail_variables as $key => $value) {

        

        $message = str_replace('{{ '.$key.' }}', $value, $message);

    }



    $mail = new PHPMailer(true);



    try {



        $mail->isSMTP();

        $mail->Host = MAIL_HOST;

        $mail->SMTPAuth = true;

        $mail->Username = MAIL_USERNAME;

        $mail->Password = MAIL_PASSWORD;

        

        //$mail->SMTPSecure = MAIL_ENCRYPTION;
        $mail->SMTPSecure = 'tls';

        $mail->Port = MAIL_PORT;



        $mail->setFrom(MAIL_USERNAME, APP_NAME);

        $mail->addAddress($to, APP_NAME);



        $mail->isHTML(true);

        $mail->Subject = $subject;

        $mail->Body    = $message;



        $mail->send();

    } 

    catch (Exception $e) {



        // for public use

        $_SESSION['STATUS']['mailstatus'] = 'message could not be sent, try again later';

        // for development use

        $_SESSION['STATUS']['mailstatus'] = 'message could not be sent. ERROR: ' . $mail->ErrorInfo;

        header("Location: ../");

        

    }



    $_SESSION['STATUS']['loginstatus'] = 'Account Created and Password send through the mail';

    header("Location: ../");

    exit();

