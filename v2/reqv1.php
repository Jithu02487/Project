<?php

include("../connection/connection.php");

include('v2session.php');

require_once("font/helveticab.php");

// set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__);

//require_once(__DIR__ . "/fpdf.php");



$fpdfPath = __DIR__ . '/fpdf.php';

//echo __DIR__;



if (file_exists($fpdfPath)) {

    require($fpdfPath);

} else {

    die('Error: The "fpdf.php" file was not found.');

}

// In reqv1.php



// Check if the 'id' parameter is present in the URL

if (isset($_GET['id'])) {

    // Retrieve the value of 'id'

    $tr_id = $_GET['id'];



    // Now, you can use $tr_id in your code as needed

   // echo "The tr_id is: " . $tr_id;

} else {

    // Handle the case when 'id' parameter is not present

    //echo "No tr_id parameter provided in the URL.";

}



$sql="select distinct localbody.name as'Name of LSGI',v1request_to_v2.type as'Waste Type',v1request_to_v2.segregated_item as 'Segregated Item',v1request_to_v2.segregated_quantity as'Segregated Quantity',v1request_to_v2.mixed_item as 'Mixed Item',v1request_to_v2.mixed_quantity as 'Mixed Quantity',mcf.location,v1request_to_v2.vehicle_access as'Vehicle Access',secretary.name as 'Assistant Secretary name',secretary.contact as 'Assistant Secretary Contact',verifier_one.v1_name as 'Verifier_One Name',verifier_one.contact as 'Verifier one contact',verifier_one.lb_id as lbid,aft_user.name as 'Area facilitaion officer',aft_user.contact as 'Area facilitaion contact',hks_user.president as 'Consortium president',hks_user.president_contact as 'Contact',hks_user.secretary as 'Consortium Secretary',hks_user.secretary_contact'Contact No',hks.account_no as 'Account No',hks.ifsc as 'IFSC code',hks_request.tr_id as trid from v1request_to_v2 join hks_request on hks_request.tr_id=v1request_to_v2.trid join hks on hks_request.hksid=hks.id join hks_user on hks.id = hks_user.hksid join mcf on mcf.v1id=hks.v1id join verifier_one on mcf.lb_id=verifier_one.lb_id join secretary on verifier_one.lb_id=secretary.lb_id join localbody on localbody.id=secretary.lb_id join aft_user on localbody.aft_id=aft_user.aft_id where hks_request.tr_id=$tr_id";

$result = $conn->query($sql);

//echo $sql;

$data = array();

while ($row = $result->fetch_assoc()) {

    $data[] = $row;

}



// Create PDF

$pdf = new FPDF();

$pdf->addPage();

$pdf->SetFont("Arial", "B", 16);

$pdf->Cell(0, 10, "Request From Verifier one", 0, 1, "C");  // Centered title

$pdf->Ln(10);  // Add some space



// Add table-like structure with two columns

$pdf->SetFont("Arial", "B", 12);

foreach ($data[0] as $field => $value) {

    if($field == 'lbid'or $field == 'trid' or $value=='') {

        continue;  // Skip the current iteration

    }

    $pdf->Cell(80, 10, ucfirst($field), 1);  // First column: Database table column headings

    $pdf->Cell(0, 10, $value, 1);  // Second column: Data from the database

    $pdf->Ln();  // Move to the next line

}



// Set headers for PDF download

header('Content-Type: application/pdf');

header('Content-Disposition: attachment; filename="output.pdf"');



// Output the PDF

$pdf->Output();



// Close the database connection

$conn->close();

?>

