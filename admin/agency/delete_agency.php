<?php

// Check if the ID is provided in the URL
if (isset($_GET['id'])) {
    $aId = $_GET['id'];

    // Create a connection
    include('../../connection/connection.php');

    // SQL query to delete the agency
    $sql1 = "DELETE FROM agency WHERE id = $aId";

    // SQL query to update the temp_agency status
    $sql2 = "UPDATE temp_agency SET status = 'Removed', s_date = CURDATE() WHERE id = $aId";

    if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
        
        // Use JavaScript to display a success message as an alert
        echo '<script>alert("Agency information deleted successfully!");</script>';

        // Redirect to a new page or back to the previous page
        header("Location: manage_agency.php");

    } else {
        // Error in deletion
        echo "Error deleting agency: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Handle the case where the ID is not provided
    echo "ID not provided.";

}

?>