<?php


include("../connection/connection.php");

include('v1session.php');

if(isset($_SESSION['v1id'])){

include("header.html");

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Government Profile</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>

        body {

            background-color: #f5f5f5;

            font-family: 'Arial', sans-serif;

        }



        .container {

            max-width: 600px;

            margin: 30px auto;

        }



        .profile {

            background-color: #ffffff;

            padding: 30px;

            border-radius: 10px;

            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);

        }



        .profile h1 {

            color: #007bff;

            font-size: 28px;

            margin-bottom: 20px;

        }



        .profile p {

            color: #555;

            font-size: 16px;

            margin-bottom: 12px;

            text-align: left; /* Align text to the left */

        }



        .btn-primary {

            background-color: #007bff;

            border-color: #007bff;

            padding: 10px 20px;

            font-size: 16px;

        }



        .btn-primary:hover {

            background-color: #0056b3;

            border-color: #0056b3;

        }

    </style>

</head>

<body>

    <div class="container">

    

        <div class="profile mt-5">

            <?php

            //include('connection.php');

            // Your PHP code

            $sql = "select * from verifier_one join users on users.email=verifier_one.v1_email where v1id=$v1id ";

            $result = $conn->query($sql);

            // Check if there are results

            if ($row = mysqli_fetch_assoc($result)) {

                echo "<h1>" . $row["v1_name"]. " ".$row["last_name"] ."</h1>";

                echo "<p>Position: " . $row["designation"] . "</p>";

                // echo "<p>Department: " . $row["department"] . "</p>";

                echo "<p>Email: " . $row["email"] . "</p>";

                echo "<p>Phone: " . $row["contact"] . "</p>";



                // Add an "Edit Profile" button

                echo "<a href='editprofilev1.php?id=1' class='btn btn-primary'>Edit Profile</a>";

            } else {

                echo "No data found in the v1profile table.";

            }



            // Close the database connection

            // $conn->close();

            ?>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>

<?php

include('footer.html');

}

else{

    header('Location:..\Login-System\login\index.php');

}

?>