<?php

// include("../connection/connection.php");

include('v1session.php');

if(isset($_SESSION['v1id'])){

include("header.html");

// Replace these with your actual database credentials

$host = "localhost";

$servername = "localhost";

$username = "dbUser";

$password = "dbPassword";

$dbname = "forward_linkage";

//include("connection.php");

try {

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    $sql = "SELECT mcf.location,mcf.ownership,mcf.agencyName,mcf.id as mcfid FROM mcf join localbody on localbody.id=mcf.lb_id join verifier_one on localbody.id=verifier_one.lb_id where verifier_one.v1id=$v1id ";

    $stmt = $pdo->query($sql);

    $mcfList = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {

    echo 'Error: ' . $e->getMessage();

}

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

                <th scope="col">ID</th>

                

                <th scope="col">Location</th>

                <th scope="col">Ownership</th>

                <th scope="col">Agency</th>

                <!-- Add more fields as needed -->

            </tr>

        </thead>

        <tbody>

            <?php foreach ($mcfList as $mcf) : ?>

                <tr>

                    <th scope="row"><?php echo $mcf['mcfid']; ?></th>

                    

                    <td><?php echo $mcf['location']; ?></td>

                    <td><?php echo $mcf['ownership']; ?> </td>

                    <td><?php echo $mcf['agencyName'];?></td>

                    <td>

                        <!-- Edit button with a link to edit_mcf.php -->

                        <a href="edit_mcf_list.php?id=<?php echo $mcf['mcfid']; ?>" class="btn btn-primary">Edit</a>

                    </td>

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