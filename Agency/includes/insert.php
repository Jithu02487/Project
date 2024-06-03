<?php
require 'db.inc.php';
session_start();
$agencyname=$_SESSION['AgencyName'];
$agencymail=$_SESSION['EmailID'];
$Address=$_SESSION['Address'];
$number=$_SESSION['ContactNumber'];
$State=$_SESSION['State'];
$City=$_SESSION['City'];
$Name1=$_SESSION['Name1'];
$Designation1=$_SESSION['Designation1'];
$CtctNumber1=$_SESSION['CtctNumber1'];
$Name2=$_SESSION['Name2'];
$Designation2=$_SESSION['Designation2'];
$CtctNumber2=$_SESSION['CtctNumber2'];
$Name3=$_SESSION['Name3'];
$Designation3=$_SESSION['Designation3'];
$CtctNumber3=$_SESSION['CtctNumber3'];
function availableAgency($conn, $agencyname){

    $sql = "select id from temp_agency where name=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {

        return $_SESSION['ERRORS']['scripterror'] = 'SQL error';
    } 
    else {

        mysqli_stmt_bind_param($stmt, "s", $agencyname);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);

        if ($resultCheck > 0) {
            
            return false;
        } else {

            return true;
        }
    }
}

function availablemail($conn, $agencymail){

    $sql = "select id from temp_agency where email=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {

        return $_SESSION['ERRORS']['scripterror'] = 'SQL Prepare Error: ' . mysqli_error($conn);;
    } 
    else {

        mysqli_stmt_bind_param($stmt, "s", $agencymail);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);

        if ($resultCheck > 0) {
            
            return false;
        } else {

            return true;
        }
    }
}

//checking is agency already registered or not

if(!availableAgency($conn, $agencyname)){
    $_SESSION['ERRORS']['name'] = 'Agency name already Exists';
            header("Location: ../");
            exit();
}else if(!availablemail($conn, $agencymail)){
    $_SESSION['ERRORS']['mail'] = 'Mail already Exists';
    header("Location: ../");
    exit();
}

  /*
        * -------------------------------------------------------------------------------
        *   Agency Creation
        * -------------------------------------------------------------------------------
        */

        if ($_FILES['document']['error'] == UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            $uploadedFile = $uploadDir . basename($_FILES['document']['name']);
    
            if (move_uploaded_file($_FILES['document']['tmp_name'], $uploadedFile)) {
                $_SESSION['STATUS']['documentstatus'] = 'Document uploaded successfully.';
            } else {
                $_SESSION['ERRORS']['documenterror'] = 'Failed to upload document.';
            }
        }

$sql = "insert into temp_agency(name, address, phone, email, state, city, p_name, 
        designation, p_phone, p2_name, 
        designation2, p2_phone, p3_name, 
        designation3, p3_phone,rate_pdf,reg_date) 
        values ( ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,now())";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {

            $_SESSION['ERRORS']['scripterror'] = 'SQL Prepare Error: ' . mysqli_error($conn);
            header("Location: ../");
            exit();
        } 
        else {

            mysqli_stmt_bind_param($stmt, "ssssssssssssssss", $agencyname, $Address, $number, $agencymail, $State, $City, $Name1, $Designation1, $CtctNumber1, $Name2, $Designation2, $CtctNumber2, $Name3, $Designation3, $CtctNumber3,$uploadedFile);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            $_SESSION['STATUS']['registrationstatus'] = 'Request Send, please Wait for aproval..';
            header("Location: ../");
            exit();
        }
        

        
?>