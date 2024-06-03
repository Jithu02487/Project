<?php

include('../connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $localtype = $_POST["localtype"];
    $area = $_POST["area"];

     // Query to fetch localbody details based on the ID
     $sql = "SELECT * FROM localbody WHERE name = '$name' and type = '$localtype' and aft_id = '$area'";
     $result = $conn->query($sql);
 
     if ($result->num_rows == 1) {

         // Use JavaScript to display message as an alert
        echo '<script>alert("Local body information already exists!");</script>';

        // Redirect to a new page or back to the previous page
        echo '<script>window.location.href = "localbodies.php";</script>';

     } 
     else {
         
        // Insert user data
        $sql1 = "INSERT INTO localbody (name, type, aft_id) VALUES ('$name', '$localtype', '$area')";

        if ($conn->query($sql1) === TRUE) {

            // Use JavaScript to display a success message as an alert
            echo '<script>alert("Local Body information inserted successfully!");</script>';

            // Redirect to a new page or back to the previous page
            echo '<script>window.location.href = "localbodies.php";</script>';

        } else {
            echo "Error: " . $conn->error;
        }

     }

    $conn->close();
}
?>