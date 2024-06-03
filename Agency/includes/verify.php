<?php
session_start();
if (isset($_POST['submit'])) {

    //filter POST data
    function input_filter($data) {
        $data= trim($data);
        $data= stripslashes($data);
        $data= htmlspecialchars($data);
        return $data;
    }
    $AgencyName = input_filter($_POST['AgencyName']);
    $Address = input_filter($_POST['Address']);
    $number = input_filter($_POST['ContactNumber']);
    $email = input_filter($_POST['EmailID']);
    $State = input_filter($_POST['inputState']);
    $City = input_filter($_POST['inputDistrict']);

    $Name1 = input_filter($_POST['Name1']);
    $Designation1 = input_filter($_POST['Designation1']);
    $CtctNumber1 = input_filter($_POST['CtctNumber1']);
    $Name2 = input_filter($_POST['Name2']);
    $Designation2 = input_filter($_POST['Designation2']);
    $CtctNumber2 = input_filter($_POST['CtctNumber2']);
    $Name3 = input_filter($_POST['Name3']);
    $Designation3 = input_filter($_POST['Designation3']);
    $CtctNumber3 = input_filter($_POST['CtctNumber3']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $_SESSION['ERRORS']['emailerror'] = 'invalid email';
        header("Location: ../");
        exit();
    }else{

        

        $_SESSION['AgencyName'] = $AgencyName;
        $_SESSION['Address'] = $Address;
        $_SESSION['ContactNumber'] = $number;
        $_SESSION['EmailID'] = $email;
        $_SESSION['State'] = $State;
        $_SESSION['City'] = $City;
        $_SESSION['Name1'] = $Name1;
        $_SESSION['Designation1'] = $Designation1;
        $_SESSION['CtctNumber1'] = $CtctNumber1;
        $_SESSION['Name2'] = $Name2;
        $_SESSION['Designation2'] = $Designation2;
        $_SESSION['CtctNumber2'] = $CtctNumber2;
        $_SESSION['Name3'] = $Name3;
        $_SESSION['Designation3'] = $Designation3;
        $_SESSION['CtctNumber3'] = $CtctNumber3;
        // echo '<script type="text/javascript">alert("' . $_SESSION['CtctNumber'] . '");</script>';
        header("Location: verifyForm.php"); 
    }
}


?>