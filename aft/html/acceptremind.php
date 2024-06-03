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



     $query = "UPDATE acceptance_pending SET number_of_reminders = number_of_reminders + 1, reminder_date = CURRENT_DATE WHERE tid = ?";

     $stmt = $conn->prepare($query);

     if ($stmt === false) {

         die('Error preparing statement: ' . $conn->error);

     }

     $stmt->bind_param("i", $ttid);

     if ($stmt->execute() === TRUE){

     // $clientEmail = "padmanabharavind@gmail";

     // $query = "SELECT al.tid,lb.name,lb.type,hk.name,a.name,al.date_of_request,al.number_of_reminders,al.reminder_date,a.email,a.email FROM acceptance_pending al INNER JOIN hks hk on al.hksid=hk.id INNER JOIN mcf m ON hk.mcf_id = m.id INNER JOIN localbody lb ON m.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id INNER JOIN agency a ON al.agency_id=a.id WHERE al.tid=$ttid";

     // $subject = "Lifting request Acceptance Pending";

     // $message = "Dear ,\n\nThis is a reminder for our services.\n\nThank you,\nYour Company Name";

     // $mailSent = mail($clientEmail, $subject, $message, $headers);

     // if (mail($clientEmail, $subject, $message)) {

     //      echo "Reminder email sent to ($clientEmail)<br>";

     //  } else {

     //      echo "Failed to send reminder email to $clientName ($clientEmail)<br>";

     //  }

     // header("Location: acceptancependingreminder.php");



     /*

    * -------------------------------------------------------------------------------

    *   Using email template

    * -------------------------------------------------------------------------------

    */

////////////////////////////////////////////////////////////////////////





///////////////////////////////////////////////////////////////////////

    $mail = new PHPMailer(true); 



//     $mail_variables = array();



//     $mail_variables['APP_NAME'] = APP_NAME;

//     $mail_variables['username'] = $username;

//     $mail_variables['email'] = $email;

//     $mail_variables['url'] = $url;

     $subject = "Lifting request Acceptance Pending";

     $message = "Dear $aname Agency,<p>This is a reminder the following Action is Pending From your End on<b>Transcation ID: $ttid </b>.<p>Waste Lifting Request Acceptance Pending\n\n<p>Requested Local Body: $lbname<p>Thank you.";

     



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

     header("Location: acceptancependingreminder.php");

 } 

 catch (Exception $e) {

        $_SESSION['ERRORS']['mailerror'] = $e->getMessage();

        

    }



}





?>







