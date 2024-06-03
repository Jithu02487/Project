<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include("../connection/connection.php");
include('v1session.php');

    $tid=$_POST['trid'];
    $invoice_number=$_POST['invoice_number'];
    $invoice_date=$_POST['invoice_date'];
    $amount_to_agencyr=$_POST['amount_to_agency'];
    $amount_to_hks=$_POST['amount_to_hks'];
    $upliftedquantity=intval($_POST['upliftedquantity']);
    $type=$_POST['type'];
    $yes="yes";
    $no="no";
    $zero=0;


    if ($_FILES['invoice_pdf']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $uploadedFile = $uploadDir . basename($_FILES['invoice_pdf']['name']);

        if (move_uploaded_file($_FILES['invoice_pdf']['tmp_name'], $uploadedFile)) {
            $_SESSION['STATUS']['documentstatus'] = 'Document uploaded successfully.';
        } else {
            $_SESSION['ERRORS']['documenterror'] = 'Failed to upload document.';
        }
    }


    $stmt = $conn->prepare("UPDATE lifting_invoice_status SET invoice=?,invoice_id=?, invoice_date=?, amount=?, payment=?,invoice_pdf=? WHERE tid=?");
    $stmt->bind_param("sisdssi",$yes,$invoice_number,$invoice_date,$amount_to_hks,$no,$uploadedFile,$tid);
    $stmt->execute();
    if ($stmt->errno) {
        echo "Error: " . $stmt->error;
    }

    if($type == "Mixed"){
        $stmt = $conn->prepare("UPDATE lifting_invoice_status SET seg_weight=?,non_seg_weight=? WHERE tid=?");
        $stmt->bind_param("ddi",$zero,$upliftedquantity,$tid);
        $stmt->execute();
        if ($stmt->errno) {
            echo "Error: " . $stmt->error;
        }

    }else{
        $stmt = $conn->prepare("UPDATE lifting_invoice_status SET seg_weight=?,non_seg_weight=? WHERE tid=?");
        $stmt->bind_param("ddi",$upliftedquantity,$zero,$tid);
        $stmt->execute();
        if ($stmt->errno) {
            echo "Error: " . $stmt->error;
        }
    }

    session_start();
    $_SESSION['insert']="Invoice updation success";
    header("Location: lifted_request.php");
    

}

?>