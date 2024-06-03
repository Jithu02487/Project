<!-- view commentline of update -->
<?php
session_start();
$v1id=$_SESSION['v1id'];
// Replace these with your database connection details
include("../connection/connection.php");
include('v1session.php');
//ho"hy";
session_start();
$trid=$_SESSION['trid'];
$lbid=$_SESSION['lbid'];
$q=
// Retrieve data from the form
$lsgi_name = $_POST['lsgi_name'];
//cho$lsgi_name;
// $grama_panchayat = $_POST['grama_panchayat'];
$v1date = date('Y-m-d');
$waste_type = $_POST['waste_type'];
$segregated_item = $_POST['segregated_item'];
$segregated_quantity = $_POST['segregated_quantity'];
$mixed_item = $_POST['mixed_item'];
$mixed_quantity = $_POST['mixed_quantity'];
$location = $_POST['location'];
$vehicle_access = $_POST['vehicle_access'];
$assistant_secretary_name = $_POST['assistant_secretary_name'];
$assistant_secretary_contact = $_POST['assistant_secretary_contact'];
$VEO_name = $_POST['VEO_name'];
$VEO_contact = $_POST['VEO_contact'];
$performance_audit_supervisor = $_POST['performance_audit_supervisor'];
$audit_supervisor_contact = $_POST['audit_supervisor_contact'];
$consortium_president = $_POST['consortium_president'];
$consortium_president_contact = $_POST['consortium_president_contact'];
$accountno = $_POST['accountno'];
$ifsc_code = $_POST['ifsc_Code'];

// Insert data into the database
$s1="select reject_status from v1request_to_v2 where trid=$trid";
// echo $s1;
$result=$conn->query($s1);
if($result->num_rows>0 or $result!=NULL){ 
    echo'hi';
while($row = $result->fetch_assoc()){
        $rs=$row["reject_status"];
}
    if($rs== "0" or $result!=NULL){
        //cho"hi in if 2";

 }
$ins="insert into v1request_to_v2 (trid,lbid,status,type,segregated_item,segregated_quantity,mixed_item,mixed_quantity,vehicle_access) values('$trid','$lbid','0','$waste_type', 
'$segregated_item', '$segregated_quantity', '$mixed_item', '$mixed_quantity','$vehicle_access')";
if ($conn->query($ins) === TRUE) {
    // echo"$sql";echo"hi in if 2"
    
    echo '<script>alert("Data Submitted");</script>';
    header('location:formsubmision.html');
} else {
    echo "Error: " . $ins . "<br>" . $conn->error;
}
$up="update hks_request set trackid='1' where tr_id=$trid";
if ($conn->query($up) === TRUE) {
    // echo"$sql";
    echo '<script>alert("updated");</script>';
} else {
    echo "Error: " . $up . "<br>" . $conn->error;
}
$date="insert into date(v1date,v2date,lbid,trid) values('$v1date','0','$lbid','$trid')";
if ($conn->query($date) === TRUE) {
    // echo"$sql";
    //echo '<script>alert("updated");</script>';
}


}else{
   $update=" UPDATE v1request_to_v2
    SET
        lbid = '$lbid',
        type = '$waste_type',
        segregated_item = '$segregated_item',
        segregated_quantity = '$segregated_quantity',
        mixed_item = '$mixed_item',
        mixed_quantity = '$mixed_quantity',
        vehicle_access = '$vehicle_access',
        remark='',
    WHERE
        trid = '$trid'";
        echo"hi in if update";
}





// Close the database connection
$up2="update v1request_to_v2 set reject_status='0' where trid=$trid";
if ($conn->query($up2) === TRUE) {
    // echo"$sql";
    // echo '<script>alert("updated");</script>';
    // header('location:formsubmision.html');
} else {
    echo "Error: " . $up2 . "<br>" . $conn->error;
}

echo"aftfer hi";
$conn->close();
?>





