<?php

// Connect to the database
include('../connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data when the form is submitted
    
    // Get the user ID from the form
    $user_id = $_POST["user_id"];
    
    // Get the updated user information from the form fields
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $designation = $_POST["designation"];
    $newUsertype = $_POST["new_usertype"];
    
    // Update the user's information in the database 
    $updateSql = "UPDATE users SET first_name = '$fname', last_name = '$lname', email = '$email', designation = '$designation', usertype = '$newUsertype' WHERE id = $user_id";
    
    if ($conn->query($updateSql) === TRUE) {
                
        // Use JavaScript to display a success message as an alert
        echo '<script>alert("User information updated successfully!");</script>';

        // Redirect to a new page or back to the previous page
        echo '<script>window.location.href = "manage_users.php";</script>';
        
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