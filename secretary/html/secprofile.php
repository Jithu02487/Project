<?php

require_once("../../connection/connection.php");

include("ssession.php");

if (isset($_SESSION['sid'])) {

//////////////////////////////////////////

include("profileheader.php");
include("footer.php");
// prepared statement to avoid SQL injection
$query = "SELECT sec.*, aft.name AS aft_name, lb.name AS localbody_name  
FROM secretary sec 
INNER JOIN localbody lb ON sec.lb_id = lb.id 
INNER JOIN aft ON lb.aft_id = aft.id 
-- INNER JOIN agency_localbody alb ON sec.lb_id = alb.lb_id 
-- INNER JOIN agency a ON alb.agency_id = a.id 
WHERE sec.id = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $sid); // Assuming $sid is an integer, adjust the type accordingly
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
die("Error: " . $conn->error);
}
     if ($result->num_rows > 0){
// output data of each row
     while ($row = $result->fetch_row()) {
// $row now contains the data of the current row as a numeric array
// You access columns by their numerical position (0-based)
       $id=$row[0];
       $name=$row[1];
       $gmail=$row[2];
       $aft_name=$row[5];
       $lb_name=$row[6];
       $phn=$row[4];
       //$agency=$row[7];
          }} 

///////////////////////////////////////////////////////
// prepared statement to avoid SQL injection
$q = "SELECT * FROM users WHERE email=?";
$stmt = $conn->prepare($q);

if (!$stmt) {
    die("Error in preparing statement: " . $conn->error);
}

// Bind the parameter
$stmt->bind_param("s", $gmail);

// Execute the query
$stmt->execute();

// Get the result
$res = $stmt->get_result();

if (!$res) {
    die("Error in query: " . $stmt->error);
}

if ($res->num_rows > 0){
    // output data of each row
    while ($r = $res->fetch_assoc()) {
        $lname=$r['last_name'];
        $desig=$r['designation'];
        $ut=$r['user_type'];}}
///////////////////////////////////////////
$query7 = "SELECT  a.name
FROM secretary sec 
INNER JOIN localbody lb ON sec.lb_id = lb.id 
INNER JOIN aft ON lb.aft_id = aft.id 
INNER JOIN agency_localbody alb ON sec.lb_id = alb.lb_id 
INNER JOIN agency a ON alb.agency_id = a.id 
WHERE sec.id = ?";
$stmt = $conn->prepare($query7);
$stmt->bind_param("i", $sid); // Assuming $sid is an integer, adjust the type accordingly
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
die("Error: " . $conn->error);
}
     if ($result->num_rows > 0){
// output data of each row
     while ($row = $result->fetch_row()) {

      
       $agency=$row[0];
          }} 
          else{$agency="Agency Not Choosed";
        }

///////////////////////////////////////////
?>
<html>
<head>
      <title>Secretary login</title>
      <link rel="stylesheet" type="text/css" href="../css/secprofile.css">
</head>
<body>


<!-----------------div 2-----------------------!>
<div id="b">

<table id="tb">
        <tr><th><?php echo"$name ";echo"$lname"; ?></th></tr>
        <tr><th>Designation : <?php echo"$desig"; ?></th>
        </tr>
        <tr><th>User Type : <?php echo"$ut"; ?></th>
        </tr>
        <tr><th>Gmail : <?php echo"$gmail"; ?></th>
        </tr>
        <tr><th>Phone Number : <?php echo"$phn"; ?></th>
        </tr>
        <tr><th>Area Facilitation Team : <?php echo"$aft_name"; ?></th>
        </tr>
        </tr>
        <tr><th>Area Facilitation Team : <?php echo"$agency"; ?></th>
        </tr>
        
        
       </table>
</div>

</body>

</html>
<?php
}
else {
    header('Location:../../Login-System/login/sessiondestory.php');
}
?>