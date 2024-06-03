<?php
// Assuming you have a database connection
include('../connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Retrieve the agency ID from the URL
$agencyId = $_GET['id'];

// Retrieve the details of the accepted agency
$sqlSelect = "SELECT * FROM temp_agency WHERE id = $agencyId";
$result = $conn->query($sqlSelect);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    // Insert the details into the accepted_agencies table
    $sql1 = "INSERT INTO agency (id, name, address, phone, email, state, city, p_name, designation, p_phone) VALUES ('" . $row["id"] . "', '" . $row["name"] . "', '" . $row["address"] . "', '" . $row["phone"] . "', '" . $row["email"] . "', '" . $row["state"] . "', '" . $row["city"] . "', '" . $row["p_name"] . "', '" . $row["designation"] . "', '" . $row["p_phone"] . "')";
    // SQL query to update the temp_agency status
    $sql2 = "UPDATE temp_agency SET status = 'Accepted', s_date = CURDATE() WHERE id = $aId";

    if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {

        // password generation ---------------------------------------------

        function generateStrongPassword($length = 12) {
            // Define characters that can be used in the password
            $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $lowercase = 'abcdefghijklmnopqrstuvwxyz';
            $numbers = '0123456789';
            $specialChars = '!@#$%^&*()-_';
        
            // Combine all character sets
            $allChars = $uppercase . $lowercase . $numbers . $specialChars;
        
            // Get the total number of characters
            $charLength = strlen($allChars);
        
            // Ensure the length is at least 8 characters
            $length = max($length, 8);
        
            // Initialize the password variable
            $password = '';
        
            // Ensure at least one character from each set is included
            $password .= $uppercase[rand(0, strlen($uppercase) - 1)];
            $password .= $lowercase[rand(0, strlen($lowercase) - 1)];
            $password .= $numbers[rand(0, strlen($numbers) - 1)];
            $password .= $specialChars[rand(0, strlen($specialChars) - 1)];
        
            // Generate the remaining characters randomly
            for ($i = strlen($password); $i < $length; $i++) {
                $password .= $allChars[rand(0, $charLength - 1)];
            }
        
            // Shuffle the password characters to make it more random
            $password = str_shuffle($password);
        
            return $password;
        }
    
        $password = generateStrongPassword();
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        $sql1 = "insert into users( email, password, first_name, last_name, 
                user_type, created_at,designation) 
                values ( ?,?,?,?, NOW(),?)";
        $verified='no';
        $stmt1 = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt1, $sql1)) {

            $_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';
            header("Location: ../");
            exit();
        } 
        else {
            $user_type="agency";
            mysqli_stmt_bind_param($stmt1, "sssss", $row["email"], $hashedPwd, $row["name"], $row["name"], $user_type);
            mysqli_stmt_execute($stmt1);

        }
    // MAIL sending----------------------------------------------

    $email=$row["email"];
    $username=$row["name"];
    $to = $email;
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
        
        $mail->SMTPSecure = MAIL_ENCRYPTION;
        $mail->Port = MAIL_PORT;

        $mail->setFrom(MAIL_USERNAME, APP_NAME);
        $mail->addAddress($to, APP_NAME);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
         // Use JavaScript to display a success message as an alert
         echo '<script>alert("Agency accepted successfully!");</script>';

         // Redirect to a new page or back to the previous page
         header("Location: manage_agency.php");
    } 
    catch (Exception $e) {

        // for public use
        $_SESSION['STATUS']['mailstatus'] = 'message could not be sent, try again later';
        // for development use
        // $_SESSION['STATUS']['mailstatus'] = 'message could not be sent. ERROR: ' . $mail->ErrorInfo;
        header("Location: ../");
        
    }
    } else {
        echo "Error accepting agency: " . $conn->error;
    }
} else {
    echo "Agency not found.";
}

// Close the database connection
$conn->close();
?>
