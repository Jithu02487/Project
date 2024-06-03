<?php
// Assuming you have a database connection
include('../../connection/connection.php');

// Retrieve the id from the query parameters
if (isset($_GET['id'])) {
    $aId = $_GET['id'];

    // Fetch the PDF content from the database based on the user_id
    $sql = "SELECT rate_pdf FROM agency WHERE id = $aId";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        $pdfPath = $row['rate_pdf'];

        // Display PDF on Webpage
        $filePath = realpath(__DIR__ . '/../../Agency/includes') . '/' . $pdfPath;
           
        if (file_exists($filePath)) {
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="' . basename($filePath) . '"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');
            readfile($filePath);
        } else {
            echo "PDF file not found.";
        }

        } else {
            // Handle the case where the file does not exist
            echo 'File not found.';
        }
    } else {
        // Handle the case where the agency ID is not found or multiple records are returned
        echo 'Agency not found or multiple records found.';
    }
    
//}
?>
