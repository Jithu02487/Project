<?php

// Connect to the database
include('../connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data when the form is submitted
    
    // Get the user ID from the form
    $lb_id = $_POST["id"];
    
    // Get the updated user information from the form fields
    $name = $_POST["name"];
    $localtype = $_POST["type"];
    $area = $_POST["aft_id"];
    
    // Update the user's information in the database 
    $updateSql = "UPDATE localbody SET name = '$name', type = '$localtype', aft_id = '$area' WHERE id = $lb_id";
    
    if ($conn->query($updateSql) === TRUE) {
                
        // Use JavaScript to display a success message as an alert
        echo '<script>alert("Local Body information updated successfully!");</script>';

        // Redirect to a new page or back to the previous page
        echo '<script>window.location.href = "localbodies.php";</script>';
        
    } else {
        echo "Error updating user information: " . $conn->error;
    }  
}
else {
    // If the request method is not POST, redirect to an error page or handle as needed
    echo "Invalid request.";
}

$conn->close();

?>