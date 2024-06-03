<?php

require_once("../../connection/connection.php");

include("aftsession.php");

if (isset($_SESSION['auid'])) {

//////////////////////////////////////////

include("profileheader.php");

include("footer.php");

// prepared statement to avoid SQL injection

$query = "SELECT aftu.*, aft.name FROM aft_user aftu INNER JOIN aft ON aftu.aft_id = aft.id WHERE aftu.id=?";

$stmt = $conn->prepare($query);



if (!$stmt) {

    die("Error in preparing statement: " . $conn->error);

}



// Bind the parameter

$stmt->bind_param("s", $auid);



// Execute the query

$stmt->execute();



// Get the result

$result = $stmt->get_result();



if (!$result) {

    die("Error in query: " . $stmt->error);

}



if ($result->num_rows > 0){

// output data of each row

     while ($row = $result->fetch_row()) {

// $row now contains the data of the current row as a numeric array

// You access columns by their numerical position (0-based)

       $name=$row[2];

       $gmail=$row[1];

       $phn=$row[4];

       $aft_name=$row[5];

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





///////////////////////////////////////////

?>

<html>

<head>

      <title>aft login</title>

      <link rel="stylesheet" type="text/css" href="../css/disprofile.css">

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