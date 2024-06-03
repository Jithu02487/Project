<?php

include("../connection/connection.php");

include('v1session.php');

if(isset($_SESSION['v1id'])){

include("header.html");

$sql = "SELECT mcf.location, mcf.agencyName, mcf.ownership, mcf.id

        FROM mcf 

        JOIN localbody ON localbody.id = mcf.lb_id 

        JOIN verifier_one ON localbody.id = verifier_one.lb_id 

        WHERE verifier_one.v1id = ?";



$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $v1id); // Assuming $v1id is an integer, adjust the type accordingly

$stmt->execute();

$result = $stmt->get_result();

if (!$result) {

    die("Query failed: " . $conn->error);

}

if ($result->num_rows > 0) {

    $mcfList = array();

 while ($row = $result->fetch_assoc()) {

        $mcfList[] = $row;

    }

} else {

   echo "No rows found.";

}

$conn->close();

?>



<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MCF List</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="stylesheet.css">

    <link rel="stylesheet" href="custom.css">

</head>

<body style="background-color: #f5f9f6;">




<div class="container mt-5">

    <h2>MCF List</h2>

    <table class="table">

        <thead>

            <tr>

                <!-- <th scope="col">ID</th> -->

                

                <th scope="col">Location</th>

                <th scope="col">Ownership</th>

                <th scope="col">Agency</th>

                <!-- Add more fields as needed -->

            </tr>

        </thead>

        <tbody>

            <?php foreach ($mcfList as $mcf) : ?>

                <tr>

                    <!-- <th scope="row"><?php echo $mcf['id']; ?></th> -->

                    

                    <td><?php echo $mcf['location']; ?></td>

                    <td><?php echo $mcf['ownership']; ?> </td>

                    <td><?php echo $mcf['agencyName'];?></td>

                    <!-- Add more fields as needed -->

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</div>



<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.min.js"></script>

</body>

</html>

<?php

include('footer.html');

}

else{

    header('Location:..\Login-System\login\index.php');

}



?>