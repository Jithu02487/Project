<?php
// Assuming you have a database connection
include('../connection.php');

// Retrieve the agency ID from the URL
$agencyId = $_GET['id'];

// Retrieve the details of the accepted agency
$sqlSelect = "SELECT * FROM temp_agency WHERE id = $agencyId";
$result = $conn->query($sqlSelect);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

     // SQL query to update the temp_agency status
     $sql = "UPDATE temp_agency SET status = 'Declined', s_date = CURDATE() WHERE id = $aId";

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
?>
