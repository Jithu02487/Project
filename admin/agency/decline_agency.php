<?php
// Check if the ID is provided in the URL
if (isset($_GET['id'])) {
    $agencyId = $_GET['id'];

    // Create a connection
    include('../../connection/connection.php');

// Retrieve the details of the registered agency
$sqlSelect = "SELECT * FROM temp_agency WHERE id = $agencyId";
$result = $conn->query($sqlSelect);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

     // SQL query to update the temp_agency status
     $sql = "UPDATE temp_agency SET status = 'Declined', s_date = CURDATE() WHERE id = $agencyId";

     if ($conn->query($sql) === TRUE) {
         // Use JavaScript to display a success message as an alert
         echo '<script>alert("Agency declined successfully!");</script>';

         // Redirect to a new page or back to the previous page
         header("Location: manage_agency.php");
     } else {
         echo "Error accepting agency: " . $conn->error;
     }
} else {
    echo "Agency not found.";
}

// Close the database connection
$conn->close();

} else {
    // Handle the case where the user ID is not provided
    echo "Agency ID not provided.";

}

?>
