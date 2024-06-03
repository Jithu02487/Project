<?php 

 session_start();

include('includes/connection.php');

if(isset($_SESSION['id'])){
    include('includes/header.php');

if(isset($_SESSION['status'])){

    echo "<script>alert('" . $_SESSION['status'] . "');</script>";
    unset($_SESSION['status']);


}

?>



<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <title>Your Page Title</title>

</head>

<body>



<!-- ***** Preloader Start ***** -->

<div id="js-preloader" class="js-preloader">

    <div class="preloader-inner">

      <span class="dot"></span>

      <div class="dots">

        <span></span>

        <span></span>

        <span></span>

      </div>

    </div>

  </div>

  <!-- ***** Preloader End ***** -->





<div class="container mt-5">

    <h2>Requests</h2>

    <?php

    $id=$_SESSION['id'];


    $sql = "SELECT v1.trid, v1.type, v1.segregated_quantity, v1.mixed_quantity, v2.hks_name, v1.status 

    FROM v1request_to_v2 AS v1 

    JOIN hks_request AS v2 ON v1.trid = v2.tr_id 

    WHERE v1.lbid IN (SELECT lb_id FROM agency_localbody WHERE agency_id = ?)";



$stmt = $conn->prepare($sql);

if (!$stmt) {

    die("Error in preparing statement: " . $conn->error);

}

$stmt->bind_param("i", $id);

$stmt->execute();

if ($stmt->errno) {

    die("Error in executing statement: " . $stmt->error);

}

$result = $stmt->get_result();

if (!$result) {

    die("Error in getting result: " . $conn->error);

}



    // Check if there are any results

    if ($result->num_rows > 0) {

        echo '<table class="table table-bordered">';

        echo '<thead class="thead-dark">';

        echo '<tr><th>Request Id</th><th>Type</th><th>Quantity</th><th>From</th><th></th></tr>';

        echo '</thead>';

        echo '<tbody>';



        // Output data of each row

        while ($row = $result->fetch_assoc()) {

            

            if ($row['status'] == 1) {

                echo '<tr>';

                echo '<td>' . $row['trid'] . '</td>';

                echo '<td>' . $row['type'] . '</td>';

                echo '<td>' . $row['segregated_quantity'] . $row['mixed_quantity']. '</td>';

                echo '<td>' . $row['hks_name'] . '</td>';

                echo '<td>';

                echo '<form method="post" action="action.php">';

                echo '<input type="hidden" name="id" value="' . $row['trid'] . '">';

                echo '<input type="hidden" name="type" value="' . $row['type'] . '">';

                echo '<input type="hidden" name="quantity" value="' . $row['segregated_quantity'] .'">';

                echo '<input type="hidden" name="name" value="' . $row['hks_name'] . '">';

                echo '<button type="submit" class="btn btn-primary">Accept</button>';

                echo '</form>';

                echo '</td>';

            }

            

            echo '</tr>';

        }



        echo '</tbody>';

        echo '</table>';

    } else {

        echo 'No results found';

    }

    $conn->close();

    ?>

</div>



<!-- Bootstrap core JavaScript -->

<script src="vendor/jquery/jquery.min.js"></script>

<script src="vendor/bootstrap/js/bootstrap.min.js"></script>



</body>

</html>

<?php



}

else{

    header("Location: ../Login-System/login");
// echo $_SESSION['id'];
}

?>