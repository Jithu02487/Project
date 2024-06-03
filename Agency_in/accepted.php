<?php 

session_start();
include('includes/connection.php');
if(isset($_SESSION['id'])){
    include('includes/header.php')

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

    <h2>Accepted Requests</h2>

    <?php

$id = $_SESSION["id"];

$sql = "SELECT v1.trid, v1.type, v1.segregated_quantity, v1.mixed_quantity, v2.hks_name, lp.date_of_lifting
        FROM v1request_to_v2 AS v1 
        JOIN lifting_pending AS lp ON v1.trid = lp.tid 
        JOIN hks_request AS v2 ON lp.tid = v2.tr_id
        WHERE lp.agency_id = $id";

    $stmt = $conn->prepare($sql);

    $stmt->execute();

    

    // Fetch the result

    $result = $stmt->get_result();

    // Check if there are any results

    if ($result->num_rows > 0) {

        echo '<table class="table table-bordered">';

        echo '<thead class="thead-dark">';

        echo '<tr><th>Request Id</th><th>Type</th><th>Quantity</th><th>From</th><th>Date for lifting</th></tr>';

        echo '</thead>';

        echo '<tbody>';



        // Output data of each row

        while ($row = $result->fetch_assoc()) {

            echo '<tr>';

            echo '<td>' . $row['trid'] . '</td>';

            echo '<td>' . $row['type'] . '</td>';

            echo '<td>' . $row['segregated_quantity'] . $row['mixed_quantity']. '</td>';

            echo '<td>' . $row['hks_name'] . '</td>';

            echo '<td>' . $row['date_of_lifting'] . '</td>';

            // if ($row['status'] == 2) {

            //     echo '<td>';

            //     echo '<form method="post" action="action.php">';

            //     echo '<input type="hidden" name="id" value="' . $row['trid'] . '">';

            //     echo '<input type="hidden" name="type" value="' . $row['type'] . '">';

            //     echo '<input type="hidden" name="quantity" value="' . $row['segregated_quantity'] .'">';

            //     // echo '<input type="hidden" name="name" value="' . $row['hks_name'] . '">';

            //     echo '<button type="submit" class="btn btn-primary">Accept</button>';

            //     echo '</form>';

            //     echo '</td>';

            //     echo '<td>';

            //     echo '<button type="button" class="btn btn-secondary">Reject</button>';

            //     echo '</td>';

            // }else{



            //     echo "<td>Accepted</td>";

            // }

            

            echo '</tr>';

        }

        echo '</tbody>';

        echo '</table>';

        

    } else {

        ?>

        <div class="text-center p-2 mb-2 bg-warning text-dark">

        <?php

        echo 'No results found';

        ?>

        </div >

        <?php

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
?>
