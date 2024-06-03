<?php

require_once("../../connection/connection.php");



     $ttid = $_POST["ttid"];



$query = "UPDATE acceptance_pending SET number_of_reminders = number_of_reminders + 1, reminder_date = CURRENT_DATE WHERE tid=$ttid";

if($conn->query($query)==TRUE){

header("Location: acceptancependingreminder.php");

}

?>