<?php
// fetch_options.php

// Inside fetch_options.php
header('Content-Type: application/json');

require '../assets/setup/db.inc.php';

$query = "SELECT name FROM aft"; // Update with your actual table and column names
$result = $mysqli->query($query);

$options = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        // Use 'name' instead of 'value' and 'text'
        $options[] = ['value' => $row['name'], 'text' => $row['name']];
    }

    // Free the result set
    $result->free();
} else {
    $options[] = ['error' => 'Error fetching options: ' . $mysqli->error];
}

// Close the database connection
$mysqli->close();

// Return options as JSON
echo json_encode($options);
?>
