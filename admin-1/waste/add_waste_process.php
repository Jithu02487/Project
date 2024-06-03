<?php

include('../connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];

     // Query to fetch localbody details based on the ID
     $sql = "SELECT * FROM waste WHERE waste_name = '$name'";
     $result = $conn->query($sql);
 
     if ($result->num_rows == 1) {

         // Use JavaScript to display message as an alert
        echo '<script>alert("Waste material information already exists!");</script>';

        // Redirect to a new page or back to the previous page
        echo '<script>window.location.href = "manage_waste.php";</script>';

     } 
     else {
         
        // Insert user data
        $sql1 = "INSERT INTO waste (waste_name) VALUES ('$name')";

        if ($conn->query($sql1) === TRUE) {

            // Use JavaScript to display a success message as an alert
            echo '<script>alert("Waste material information inserted successfully!");</script>';

            // Redirect to a new page or back to the previous page
            echo '<script>window.location.href = "manage_waste.php";</script>';

        } else {
            echo "Error: " . $conn->error;
        }

     }

    $conn->close();
}
?>