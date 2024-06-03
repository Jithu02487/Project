<?php









$servername = "localhost";

$username = "dbUser";

$password = "dbPassword";

$dbname = "forward_linkage";



// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);



// Check connection

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}

// $conn = mysqli_connect("localhost","root","","forwardlinkage");

// if (!$conn) {

//   echo "Failed to connect to MySQL: " . mysqli_connect_error();

//   exit();

// }

/*if ($result = mysqli_query($con,"SELECT * FROM TEST")) {

  echo "Returned rows are: " . $result -> num_rows;

  // Free result set

  $result -> free_result();

}*/



?>