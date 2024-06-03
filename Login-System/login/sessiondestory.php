<?php

session_start();

session_unset();



session_destroy();

// Check if the session is active

if (session_status() === PHP_SESSION_ACTIVE) {

    echo "Session is active.";

} else {

       echo'<script>history.replaceState(null, null, "index.php");window.location.href = "index.php";</script>';

}

?>



