<?php

// Check if the ID is provided in the URL
if (isset($_GET['id'])) {
    $localId = $_GET['id'];

    // Create a connection
    include('../../connection/connection.php');

    // SQL query to delete the user
    $sql = "DELETE FROM localbody WHERE id = $localId";

    if ($conn->query($sql) === TRUE) {
        
        // Use JavaScript to display a success message as an alert
        echo '<script>alert("Local Body information deleted successfully!");</script>';

        // Redirect to a new page or back to the previous page
        header("Location: localbodies.php");

    } else {
        // Error in deletion
        echo "Error deleting local body: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Handle the case where the ID is not provided
    echo "ID not provided.";

}

?>