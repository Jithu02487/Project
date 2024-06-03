<?php

require_once("../../connection/connection.php");

     include("aftsession.php");

     if (isset($_SESSION['auid'])) {

     $ttid = $_POST["ttid"];



$query = "UPDATE acceptance_pending SET number_of_reminders = number_of_reminders + 1, reminder_date = CURRENT_DATE WHERE tid = ?";

$stmt = $conn->prepare($query);



if ($stmt === false) {

    die('Error preparing statement: ' . $conn->error);

}

$stmt->bind_param("i", $ttid);



if ($stmt->execute() === TRUE) {

    header("Location: acceptancependingreminder.php");

} else {

    die('Error executing statement: ' . $stmt->error);

}



// Close the statement

$stmt->close();





}

else {

    header('Location:../../Login-System/login/sessiondestory.php');

}

?>