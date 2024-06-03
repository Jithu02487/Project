<?php

// Check if the user ID is provided in the URL
if (isset($_GET['id'])) {
    $wId = $_GET['id'];

    // Create a connection
    include('../connection.php');

    // SQL query to delete the user
    $sql = "DELETE FROM waste WHERE waste_id = $wId";

    if ($conn->query($sql) === TRUE) {
        
        // Use JavaScript to display a success message as an alert
        echo '<script>alert("Waste material information deleted successfully!");</script>';

        // Redirect to a new page or back to the previous page
        header("Location: manage_waste.php");

    } else {
        // Error in user deletion
        echo "Error deleting user: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Handle the case where the user ID is not provided
    echo "ID not provided.";

}

?>