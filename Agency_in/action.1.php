<?php

session_start();

include('includes/connection.php');

$aid=$_SESSION['id'];

$tid=$_SESSION['tid'];

$type=$_SESSION['type'];

$quantity=$_SESSION['quantity'];

$name=$_SESSION['name'];

if(isset($_POST['submit'])){



    $date=$_POST['date'];

    $quantity=$_POST['quantity'];

    $contactNumber=$_POST['contactNumber'];

    $vehicleNumber=$_POST['vehicleNumber'];

    $vehicleType=$_POST['vehicleType'];

    $accDate=date("Y/m/d");

    $sql = "SELECT hksid,date FROM hks_request WHERE hks_name = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $name); 

    $stmt->execute();

    $result = $stmt->get_result();

    $row = $result->fetch_assoc();

    $hksid = $row['hksid'];

    $rdate = $row['date'];;









    // inserting to lifting_pending

    $sql1 = "INSERT INTO lifting_pending (tid, hksid, agency_id,

     date_of_request, date_of_acceptance,reminder_date, date_of_lifting, pn_number, vehicle_num, 

     vehicle_type, quantity_uplifted) VALUES (?,?,?,?,?,?,?,?,?,?,?)";

    $stmt1 = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt1,$sql1)){

        $error = mysqli_stmt_error($stmt1);

        echo "Error: " . $error;
        exit();

    }else{

    $stmt1->bind_param("iiisssssssi", $tid, $hksid, $aid, $rdate, $accDate, $accDate, $date, $contactNumber, $vehicleNumber, $vehicleType, $quantity);

    $stmt1->execute();

    }

    // Updating acceptance_pending status to 2

    $sql2 = "UPDATE v1request_to_v2 SET status = '2' WHERE trid=?";

    $stmt1 = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt1,$sql2)){

        $error = mysqli_stmt_error($stmt1);

        echo "Error: " . $error;
        exit();

    }else{

        $stmt1->bind_param("i",$tid);

        $stmt1->execute();

    }

    



    // Deleting from acceptance_pending

    $sql3="delete from acceptance_pending where tid=?";

    $stmt1 = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt1,$sql3)){

        $error = mysqli_stmt_error($stmt1);

        echo "Error: " . $error;
        exit();

    }else{

        $stmt1->bind_param("i",$tid);

        $stmt1->execute();

    }

    

    $_SESSION['status']="The request is accepted and the acknowledgment send";

    header("Location: index.php");



    // $stmt1 = mysqli_stmt_init($conn);

    //             if (!mysqli_stmt_prepare($stmt1, $sql3)) {

    //                 $error = mysqli_stmt_error($stmt1);

    //                 echo "Error: " . $error;

                    

    //             }



}



?>