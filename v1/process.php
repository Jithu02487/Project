<?php
include("../connection/connection.php");
include('v1session.php');

// Receive the JSON data from the POST request
$jsonData = file_get_contents("php://input");

// Decode the JSON data into a PHP array
$requestData = json_decode($jsonData, true);

// Access 'selectedItems' and 'trid' from the requestData array
$selectedItems = $requestData['selectedItems'];
$trid = $requestData['trid'];

// Assuming your database connection is established in connection.php

// Prepared statement for inserting data
$stmt = $conn->prepare("INSERT INTO mixed_items (tid, item, weight) VALUES (?, ?, ?)");
$stmt1 = $conn->prepare("SELECT item FROM mixed_items WHERE tid = ?");
$stmt1->bind_param("i", $trid);
foreach ($selectedItems as $item) {
    // Sanitize and escape data to prevent SQL injection
    $dropdownItem = mysqli_real_escape_string($conn, $item['dropdown_item']);
    $value = mysqli_real_escape_string($conn, $item['value']);


    
    $stmt1->execute();
    $result = $stmt1->get_result();
    // Initialize a flag to check if the condition is met
    $conditionMet = true;

    while ($row = $result->fetch_assoc()) {
        $item = $row['item'];

        if ($item == $dropdownItem) {
            $conditionMet = false;
        }
    }


            if($conditionMet){
                // Bind parameters to the prepared statement
                $stmt->bind_param("isi", $trid, $dropdownItem, $value);

                 // Execute the prepared statement
                    if (!$stmt->execute()) {
                    echo "Error: " . $stmt->error;
                    echo json_encode(["Error:" =>$stmt->error]);
                }
            }
    
}

// Close the statement
$stmt->close();

// Close the database connection
$conn->close();

// Send a response back to the JavaScript (optional)
echo json_encode(["status" => "success", "message" => "Data received and stored in the database."]);
?>
