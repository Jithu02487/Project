<?php 

include("../connection/connection.php");

include('v1session.php');

if(isset($_SESSION['v1id'])){

include("header.html");

if(isset($_SESSION['insert'])){

    echo("<script>alert('Invoice updation success');</script>");

    unset($_SESSION['insert']);

}



$sql = "SELECT * FROM hks_request 

        WHERE hks_request.tr_id IN (

            SELECT tid FROM lifting_invoice_status 

            JOIN hks ON lifting_invoice_status.hks_id = hks.id 

            JOIN mcf ON mcf.v1id = hks.v1id 

            JOIN verifier_one ON verifier_one.lb_id = mcf.lb_id 

            WHERE invoice = 'no' AND verifier_one.v1id = ?)";



$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $v1id); // Assuming $v1id is an integer, adjust the type accordingly

$stmt->execute();

$result = $stmt->get_result();



if (!$result) {

    die("Query failed: " . mysqli_error($conn));

}

?>

<!DOCTYPE html>

<html>

<head>

<link rel="stylesheet" type="text/css" href="table.css">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Data Display</title>

</head>

<body>

    <table class="data-table">

        <tr class="center"  >

            <th>SL.NO</th> 

            <th>Date Of Submission</th>

            <th>Type</th>

            <th>Weight</th>

            <th>Data entry</th>

        </tr>

        <?php

        if ($result->num_rows > 0) {

            $i=1;

            while ($row = $result->fetch_assoc()) {

                echo "<tr class='white-row'>";

                echo "<td class='center'>" .$i . "</td>";

                echo "<td class='center'>" . $row["date"] . "</td>";

                echo "<td class='center'>" . $row["type"] . "</td>";

                echo "<td class='center'>" . $row["weight"] . "</td>";

                echo "<td class='center color'><a class='btn btn view-button' href='actual_lifting_v1.php?id=". $row["tr_id"] ."'>Click hHere</a></td>";

        

                $i=$i+1;

            }

        } else {

            echo "<tr><td colspan='5' class='center'>No data found</td></tr>";

        }

        $conn->close();

        ?>

    </table>

<?php

include('footer.html');

}

else{

    header('Location:..\Login-System\login\index.php');

}

?>

