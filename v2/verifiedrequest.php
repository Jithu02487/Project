<!-- Makesure the verifier one id in sql -->

<?php

include("../connection/connection.php");

include('v2session.php');

if(isset($_SESSION['id'])){

include('headerv2.html');

$l = "select lb_id from verifier_two where v2id =$v2id";

$r = $conn->query($l);

//echo$l;

if ($r !== false) {

    if ($r->num_rows > 0) {

        $ro = $r->fetch_assoc();

        $lbid = $ro['lb_id'];

    }

} else {

    die("Error in query execution: " . $conn->error);

}

// Fetch data from the database

$sql = "SELECT * FROM hks_request join v1request_to_v2 on v1request_to_v2.trid=hks_request.tr_id WHERE tr_id IN ( SELECT trid FROM v1request_to_v2 JOIN verifier_two ON verifier_two.lb_id = v1request_to_v2.lbid WHERE v1request_to_v2.lbid ='43'  AND  v1request_to_v2.status ='1')";



$result = $conn->query($sql);

//echo"$sql";

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();

    $trid= $row["tr_id"];

}

// $s2="select * from  hks_request where tr_id=$trid";

// $result2 = $conn->query($s2);

// }

// else {

// echo '<div style="text-align: center; margin-top: 20px; color: #555;">';

// echo '<p><strong>Nothing to display at the moment.</strong></p>';

// echo '<p>Please check back later or try a different search.</p>';

// echo '</div>';

// }

?>



<!DOCTYPE html>

<html lang="en">

<html>

<head>

<link rel="stylesheet" type="text/css" href="table.css">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

   



    <title>Data Display</title>

</head>

<body>

    



        <table class='data-table'>

        <tr class='center'  >

            <!-- <th>ID</th>

            <th>HksID</th> -->

            <th>HKS</th> <!-- Fixed the closing th tag here -->

            <!-- <th>RequestID</th> -->

            <th>Date</th> <!-- Moved the Date heading to the correct position -->

            <th>Weight</th>

            <th>Type</th>

            <th></th>

        </tr>

        <?php

if ($result->num_rows > 0) {

    while ($row2 = $result->fetch_assoc()) {



            if(!$row2["segregated_quantity"]){

            $w=$row2["mixed_quantity"];

            }

            else{

            $w=$row2["segregated_quantity"];

            }

        // Additional code for calculating weight based on conditions

        $w = $row2["segregated_quantity"] ? $row2["segregated_quantity"] : $row2["mixed_quantity"];



        echo "<tr class='white-row'>";

        echo "<td class='center'>" . $row2['hks_name'] . "</td>";

        echo "<td class='center'>" . $row2['date'] . "</td>";

        echo "<td class='center'>" . $w . "</td>";

        echo "<td class='center'>" . $row2['type'] . "</td>";

        echo "<td class='center color'><a class='btn btn view-button' href='reqv1.php?id=" . $row2["tr_id"] . "'>View</a></td>";

        echo "</tr>";

    }

} else {

    // Display a message when no data is available

    echo '<tr><td colspan="5" class="center">No data available.</td></tr>';

}

?>

    </table>

    

</body>

</html>

<?php

include('footer.html');

}

else{

    header('Location:..\Login-System\login\index.php');

}

?>