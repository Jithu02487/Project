<?php
include("../connection/connection.php");
include('v2session.php');
if(isset($_GET["id"])){
    $trid = $_GET["id"];
}
$v2date=date('Y-m-d');
$sql="update v1request_to_v2 set status='1' where trid=$trid";
$result = $conn->query($sql);
//echo$sql;

$sql2="update hks_request set trackid='2' where tr_id=$trid";
$result2 = $conn->query($sql2);
//echo $sql2;
$sql10="UPDATE date SET v2date = '" . date('Y-m-d') . "' WHERE trid = $trid";;
$result10 = $conn->query($sql10);
if($result and $result2){    
    echo '<script>alert("Approved And Submited");</script>';
    header('location:listofverifiedrequestfromv1.php');
}
else{
    echo '<script>alert("Something Went to Wrong        ");</script>';
}


$fetch="select hks_request.date,date.v2date,date.lbid from hks_request join date  on date.trid=hks_request.tr_id where hks_request.tr_id=$trid and  date.trid=$trid" ;
$result3=$conn->query($fetch);
if ($result3->num_rows > 0) {
    while($row3 = $result3->fetch_row()){  // Use fetch_assoc to get an associative array
        $reqdate = $row3[0];  // Replace with the actual column name
       // $v2date = $row3[1];  // Replace with the actual column name
        $lbid=$row3[2];
       
    }
}
$query="select a.agency_id,h.hksid FROM verification v JOIN agency_localbody a on a.lb_id=v.lb_id JOIN hks_request h ON h.tr_id=v.tid";
$r=$conn->query($query);
if($r->num_rows>0){
    while($row4 = $r->fetch_row()){
            $aid=$row4[0];
            $hksid=$row4[1];
}}
$v2date=date('Y-m-d');
$sql3 = "INSERT INTO verification VALUES ('$trid', 'yes', '$reqdate', '$v2date', '$lbid')";
$result3 = $conn->query($sql3);
$q="INSERT INTO acceptance_pending VALUES ('$trid', '$hksid', '$aid', '$v2date', 0, '$v2date')";
$result13 = $conn->query($q);
if ($result3) {
    echo '<script>alert("Successfully inserted into verification table.");</script>';
    // header('location:listofverifiedrequestfromv1.php');
} else {
    echo '<script>alert("Error: ' . $conn->error . '");</script>';
}


?>