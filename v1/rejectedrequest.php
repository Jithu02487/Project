

  <?php

  

 

  include("../connection/connection.php");

  include('v1session.php');

  if(isset($_SESSION['v1id'])){

  include("header.html");

// Example database connection (replace with your actual database connection)

 $host = 'localhost';

// $servername = "localhost";

 $username = "dbUser";

 $password = "dbPassword";

 $dbname = "forward_linkage";

// //$host="forwardlinkage";

$s = "SELECT lb_id FROM verifier_one WHERE v1id = ?";



$stmt = $conn->prepare($s);

$stmt->bind_param("i", $v1id); // Assuming $v1id is an integer, adjust the type accordingly

$stmt->execute();

$result = $stmt->get_result();



if (!$result) {

    die("Error: " . $conn->error);

}

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();

    $lbid = $row['lb_id'];

   //echo "Lbid: $lbid";

} else {

    // No records found

    echo "No records found.";

}



// Close the result set if it's not already closed

if ($result instanceof mysqli_result) {

    $result->close();

}





try {

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    // Fetch rejected applications data from the database

    // Replace 'your_value' with the actual value



$query = 'SELECT distinct v1request_to_v2.trid, v1request_to_v2.remark, date.v2date, v1request_to_v2.lbid 

          FROM date 

          JOIN v1request_to_v2 ON date.v1dataid = v1request_to_v2.dataid 

          WHERE v1request_to_v2.lbid = "' . $lbid . '" AND v1request_to_v2.reject_status = "1"';



//echo "Query: $query";



$stmt = $pdo->query($query);



// Rest of your code...



    $rejectedApplications = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {

    echo 'Connection failed: ' . $e->getMessage();

}

?>



<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Rejected Applications</title>

    <!-- Bootstrap CSS link -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>

        body {

            background-color: #f8f9fa; /* Add a light background color for better readability */

        }



        .container {

            margin-top: 50px;

        }



        .card {

            margin-bottom: 20px;

        }

    </style>

</head>

<body>

    <div class="container">

        <h2>Rejected Applications</h2>



        <?php foreach ($rejectedApplications as $application): ?>

            <div class="card">

                <div class="card-body">

                    <h5 class="card-text">Transaction ID: <?= $application['trid'] ?></h5>

                    <p class="card-text">Reason for rejection: <?= $application['remark'] ?></p>

                    <p class="card-text">Date of submission: <?= $application['v2date'] ?></p>

                    <a href="v1form1.php?id=<?= $application['trid'] ?>&lbid=<?= $application['lbid'] ?>" class="btn btn-primary">Edit</a>



                  </div>

            </div>

        <?php endforeach; ?>



        <!-- Add more cards for additional rejected applications -->



    </div>





  



   

   

  

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>





<?php

include('footer.html');

}

else{

    header('Location:..\Login-System\login\index.php');

}

?>  







