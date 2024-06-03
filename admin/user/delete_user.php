<?php

// Check if the user ID is provided in the URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Create a connection
    include('../../connection/connection.php');

    // SQL query to delete the user
    $sql = "DELETE FROM users WHERE id = $userId";

    if ($conn->query($sql) === TRUE) {
        
        // Use JavaScript to display a success message as an alert
        echo '<script>alert("User information deleted successfully!");</script>';

        // Redirect to a new page or back to the previous page
        header("Location: manage_users.php");

    } else {
        // Error in user deletion
        echo "Error deleting user: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Handle the case where the user ID is not provided
    echo "User ID not provided.";

}

?>