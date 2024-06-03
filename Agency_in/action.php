

<?php 

include('includes/header.php');

include('includes/connection.php');

session_start();

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



<div class="container mt-5 shadow p-3 mb-5 rounded bg-light text-dark">

<?php

$_SESSION['tid']=$_POST['id'];

$_SESSION['type']=$_POST['type'];

$_SESSION['quantity']=$_POST['quantity'];

$_SESSION['name']=$_POST['name'];

echo '<table class="table table-bordered">';

echo '<thead class="thead-dark">';

echo '<tr><th>Request Id</th><th>Type</th><th>Quantity</th><th>From</th></tr>';

echo '</thead>';

echo '<tbody>';

echo '<tr>';

echo '<td>' . $_POST['id'] . '</td>';

echo '<td>' . $_POST['type'] . '</td>';

echo '<td>' . $_POST['quantity'] . '</td>';

echo '<td>' . $_POST['name'] . '</td>';

// Add additional cells for other data items if needed

echo '</tr>';

echo '</tbody>';

echo '</table>';



?>

<hr>

<form class="form-horizontal " action="action.1.php" method="post">

  <div class="form-group">

    <label class="control-label col-sm-2" for="Date">Date of lifting :</label>

    <div class="col-sm-10">

      <input type="date" class="form-control" id="date" name="date" required>

    </div>

    <br>

    <div class="form-group">

    <label class="control-label col-sm-2" for="quantity">Quantity Uplifted (kg):</label>

    <div class="col-sm-10">

      <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity" required>

    </div>

    <br>

  </div>

  <div class="form-group">

    <label class="control-label col-sm-2" for="pwd">Contact Number</label>

    <div class="col-sm-10">

    <input type="text" class="form-control" id="contactNumber" name="contactNumber" placeholder="Contact number" pattern="[0-9]{10}" title="Please enter a 10-digit phone number" required>



    </div>

    <br>

  </div>

  <div class="form-group">

    <label class="control-label col-sm-2" for="pwd">Vehicle Number</label>

    <div class="col-sm-10">

    <input type="text" class="form-control" id="vehicleNumber" name="vehicleNumber" placeholder="Vehicle Number" pattern="[A-Z]{2}\d{2}[A-Z]{1,2}\d{4}" title="Please enter a valid vehicle number in the format KL04L8052" required>





    </div>

    <br>

  </div>

  <div class=" form-group">

    <label class="control-label col-sm-2" for="pwd">Vehicle Type</label>

    <!-- Example single danger button -->

    <div class="col-sm-10">

            <select class="form-control" id="vehicleType" name="vehicleType" required>

                <option value="">Vehicle Type</option>

                <option value="Heavy">Heavy</option>

                <option value="Medium">Medium</option>

                <option value="Light">Light</option>

            </select>

        </div>

        <br>

  <div class="form-group">

    <div class="col-sm-offset-2 col-sm-10">

      <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>

    </div>

  </div>

</form>



</div>

<!-- Bootstrap core JavaScript -->

<script src="vendor/jquery/jquery.min.js"></script>

<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>



