<?php

     use PHPMailer\PHPMailer\PHPMailer;

     use PHPMailer\PHPMailer\Exception;

     require 'vendor/env.php';

     require 'vendor/PHPMailer/src/Exception.php';

     require 'vendor/PHPMailer/src/PHPMailer.php';

     require 'vendor/PHPMailer/src/SMTP.php';

     require_once("../../connection/connection.php");



     $ttid = $_POST["ttid"];

     $lbname=$_POST["lbname"];

     $aname=$_POST["aname"];

     $to=$_POST["aemail"];







     $query = "UPDATE lifting_pending SET number_of_reminders = number_of_reminders + 1, reminder_date = CURRENT_DATE WHERE tid = ?";

     $stmt = $conn->prepare($query);

     

     if (!$stmt) {

         die("Error in preparing statement: " . $conn->error);

     }

     

     // Bind the parameter

     $stmt->bind_param("s", $ttid);

     

     // Execute the query

     if ($stmt->execute() === TRUE){

///////////////////////////////////////////////////////////////////////

$mail = new PHPMailer(true); 



//     $mail_variables = array();



//     $mail_variables['APP_NAME'] = APP_NAME;

//     $mail_variables['username'] = $username;

//     $mail_variables['email'] = $email;

//     $mail_variables['url'] = $url;

     $subject = "Waste Lifting Pending";

     $message = "Dear $aname Agency,<p>This is a reminder the following Action is Pending From your End on<b>Transcation ID: $ttid </b>.<p>Waste Lifting Pending\n\n<p>Requested Local Body: $lbname<p>Thank you.";

     



//     foreach($mail_variables as $key => $value) {

        

//         $message = str_replace('{{ '.$key.' }}', $value, $message);

//     }



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

     session_start();

     $_SESSION['status']="Reminder Send success";

     header("Location: liftingpendingreminder.php");

 } 

 catch (Exception $e) {

        $_SESSION['ERRORS']['mailerror'] = $e->getMessage();

        

    }

}

?>