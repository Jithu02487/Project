<?php

require_once("../../connection/connection.php");

include("dsession.php");

//////////////////////////////////////////

if (isset($_SESSION['did'])) {

include("profileheader.php");

include("footer.php");

// prepared statement to avoid SQL injection

$query = "SELECT * FROM district WHERE id=?";

$stmt = $conn->prepare($query);

$stmt->bind_param("s", $did); // Assuming $did is a string, adjust the type accordingly

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

       $phn=$row[3];

 

          }}

///////////////////////////////////////////////////////

// prepared statement to avoid SQL injection

$q = "SELECT * FROM users WHERE email=?";

$stmt = $conn->prepare($q);

$stmt->bind_param("s", $gmail); // Assuming $gmail is a string, adjust the type accordingly

$stmt->execute();

$res = $stmt->get_result();



if (!$res) {

    die("Error: " . $conn->error);

}



if ($res->num_rows > 0){

    // output data of each row

    while ($r = $res->fetch_assoc()) {

        $lname=$r['last_name'];

        $desig=$r['designation'];

        $ut=$r['user_type'];}}

///////////////////////////////////////////

?>

<html>

<head>

      <title>district login</title>

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