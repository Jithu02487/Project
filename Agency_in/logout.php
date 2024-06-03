<?php 
// Start the session

session_start();



// Destroy the session data

session_destroy();



// Redirect to the login page

header('Location:..\..\Login-System\login\index.php');

exit;

?>