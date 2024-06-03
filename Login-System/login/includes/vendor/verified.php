<?php
    session_start();
    require '../../../assets/setup/db.inc.php';
    $email = $_SESSION["email"];
    if($_POST['verified']=="yes"){
        
			$query = "UPDATE users SET verified = 'yes' WHERE email ='$email'";
            $result = $conn->query($query);
                if ($result === true){
// DISTRICT login--------------------------------------------
         if($_SESSION['user_type']=="district"){
            $query = "select * from district where email='$email'";
            $result = $conn->query($query);
            if ($result->num_rows > 0){
 // output data of each row
            while ($r = $result->fetch_row()) {
              $did=$r[0];}}
      //section start
      session_start();
      $_SESSION['did']=$did; 
            header("Location: ../../../district/html/dishome.php");
        exit();
        }

// V1 login--------------------------------------------
        if($_SESSION['user_type']=="v1"){ 
            $query = "select * from verifier_one where v1_email='$email'";
            $result = $conn->query($query);
            if ($result->num_rows > 0){
            // output data of each row
            while ($row = $result->fetch_row()) {
            $id=$row[0];}}
            //section start
            $_SESSION['v1id']=$id;
            $_SESSION['email']=$eml;
            // header("Location: ../../../v1/logedin.php");
            header("Location: 2FA.php");
        exit();
        }

// V2 login--------------------------------------------
        if($_SESSION['user_type']=="v2"){
            $query = "select * from verifier_two where v2_email='$email'";
            $result = $conn->query($query);
            if ($result->num_rows > 0){
            // output data of each row
            while ($row = $result->fetch_row()) {
            $id=$row[0];}}
            //section start
            $_SESSION['id']=$id;
            header("Location: ../../../v2/v2front.php");
        exit();
        }

// AFT login--------------------------------------------
        if($_SESSION['user_type']=="aft"){
            $query = "select * from aft_user where email='$email'";
            $result = $conn->query($query);
            if ($result->num_rows > 0){
            // output data of each row
            while ($row = $result->fetch_row()) {
            $auid=$row[0];}
             //section start
             $_SESSION['auid']=$auid;
             header("Location: ../../../../aft/html/afthome.php");
         exit();
        }else{
            echo "<script>alert('No rows found');</script>";
            }
           
        }


// SECRETARY login--------------------------------------------
        if($_SESSION['user_type']=="secretary"){
            $query = "select * from secretary where email='$email'";
            $result = $conn->query($query);
            if ($result->num_rows > 0){
            // output data of each row
            while ($row = $result->fetch_row()) {
                $sid=$row[0];}}
        //section start
        session_start();
        $_SESSION['sid']=$sid;
            header("Location: f-linkage\secretary\html\sechome.php");
        exit();
        }

        // HKS LOGIN ------------------------------------------
if($_SESSION['user_type']=="hks"){
$query = "select * from hks where email='$email'";
$result = $conn->query($query);
if ($result->num_rows > 0){
// output data of each row
while ($row = $result->fetch_row()) {
    $sid=$row[0];}}
//section start
session_start();
$_SESSION['sid']=$sid;
header("Location: ../../../hks/hksfront.php");
exit();
}

// AGENCY LOGIN ------------------------------------------
if($_SESSION['user_type']=="agency"){
$query = "select * from agency where email='$email'";
$result = $conn->query($query);
if ($result->num_rows > 0){
// output data of each row
while ($row = $result->fetch_row()) {
    $id=$row[0];}}
//section start
session_start();
$_SESSION['id']=$id;
header("Location: ../../../Agency_in/index.php");
exit();
}

// ADMIN LOGIN -------------------------------------
if($_SESSION['user_type']=="admin"){

$_SESSION['a']=1;

header("Location: ../../../../admin/admin_dashboard.php");

exit();

}
                    }else{
                        echo "fauls";
                    }
    }

    if($_POST['authenticated']=="yes"){
         // DISTRICT login--------------------------------------------
         if($_SESSION['user_type']=="district"){
            $query = "select * from district where email='$email'";
            $result = $conn->query($query);
            if ($result->num_rows > 0){
 // output data of each row
            while ($r = $result->fetch_row()) {
              $did=$r[0];}}
      //section start
      session_start();
      $_SESSION['did']=$did; 
            header("Location: ../../../district/html/dishome.php");
        exit();
        }

// V1 login--------------------------------------------
        if($_SESSION['user_type']=="v1"){ 
            $query = "select * from verifier_one where v1_email='$email'";
            $result = $conn->query($query);
            if ($result->num_rows > 0){
            // output data of each row
            while ($row = $result->fetch_row()) {
            $id=$row[0];}}
            //section start
            $_SESSION['v1id']=$id;
            $_SESSION['email']=$eml;
            // header("Location: ../../../v1/logedin.php");
            header("Location: 2FA.php");
        exit();
        }

// V2 login--------------------------------------------
        if($_SESSION['user_type']=="v2"){
            $query = "select * from verifier_two where v2_email='$email'";
            $result = $conn->query($query);
            if ($result->num_rows > 0){
            // output data of each row
            while ($row = $result->fetch_row()) {
            $id=$row[0];}}
            //section start
            $_SESSION['id']=$id;
            header("Location: ../../../v2/v2front.php");
        exit();
        }

// AFT login--------------------------------------------
        if($_SESSION['user_type']=="aft"){
            $query = "select * from aft_user where email='$email'";
            $result = $conn->query($query);
            if ($result->num_rows > 0){
            // output data of each row
            while ($row = $result->fetch_row()) {
            $auid=$row[0];}
             //section start
             $_SESSION['auid']=$auid;
             header("Location: ../../../../aft/html/afthome.php");
         exit();
        }else{
            echo "<script>alert('No rows found');</script>";
            }
           
        }


// SECRETARY login--------------------------------------------
        if($_SESSION['user_type']=="secretary"){
            $query = "select * from secretary where email='$email'";
            $result = $conn->query($query);
            if ($result->num_rows > 0){
            // output data of each row
            while ($row = $result->fetch_row()) {
                $sid=$row[0];}}
        //section start
        session_start();
        $_SESSION['sid']=$sid;
            header("Location: f-linkage\secretary\html\sechome.php");
        exit();
        }

        // HKS LOGIN ------------------------------------------
if($_SESSION['user_type']=="hks"){
$query = "select * from hks where email='$email'";
$result = $conn->query($query);
if ($result->num_rows > 0){
// output data of each row
while ($row = $result->fetch_row()) {
    $sid=$row[0];}}
//section start
session_start();
$_SESSION['sid']=$sid;
header("Location: ../../../hks/hksfront.php");
exit();
}

// AGENCY LOGIN ------------------------------------------
if($_SESSION['user_type']=="agency"){
$query = "select * from agency where email='$email'";
$result = $conn->query($query);
if ($result->num_rows > 0){
// output data of each row
while ($row = $result->fetch_row()) {
    $id=$row[0];}}
//section start
session_start();
$_SESSION['id']=$id;
header("Location: ../../../Agency_in/index.php");
exit();
}

// ADMIN LOGIN -------------------------------------
if($_SESSION['user_type']=="admin"){

$_SESSION['a']=1;

header("Location: ../../../../admin/admin_dashboard.php");

exit();

}

            }
?>