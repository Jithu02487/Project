<?php
include("../connection/connection.php");
include('hkssession.php');
if(isset($_SESSION['id'])){
include("headerhks.html");
$trid='';
// Initialize variables
$trid = isset($_GET['id']) ? $_GET['id'] : null;
$date = date('Y-m-d');
$localbodyname = $mcfloc = $hksname = '';


// Fetch data from the database
$query = "SELECT localbody.name, mcf.location, hks.hks_name ,hks.id FROM hks JOIN mcf ON hks.v1id = mcf.v1id JOIN localbody ON mcf.lb_id = localbody.id WHERE hks.id='$hksid'";
$result = $conn->query($query);

// Check if the query executed successfully
if (!$result) {
    die("Query failed: " . $conn->error);
} else {
    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // Fetch the data
        while ($row = $result->fetch_row()) {
            $localbodyname = $row[0];
            $mcfloc = $row[1];
            $hksname = $row[2];
            $hksid=$row[3];
        }
    } else {
        echo "No rows found.";
    }

    // Free the result set
    $result->free();
}

// Close the database connection


// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $trid = $_POST['trid'];
    $date = $_POST['date'];
    $driver = $_POST['driver'];
    $vehicleno = $_POST['vehicleno'];
    $lsgi = $_POST['lsgi'];
    $location = $_POST['location'];
    $quantity=$_POST['quantity'];

    // Insert data into the actual_lift table
    $query2 = "INSERT INTO actual_lift (actual_date_hks, driver_name, vehicle_no, trid, mcfloc, lsginame,quantity) VALUES ('$date', '$driver', '$vehicleno', '$trid', '$location', '$lsgi','$quantity')";
    
    // Check if the insertion was successful
    if ($conn->query($query2) === TRUE) {
        //echo$query2;
        //header("location:formsubmision.html");
    } else {
        echo "Error: " . $query2 . "<br>" . $conn->error;
    }
    $q = "select * from lifting_pending where tid = $trid";
    // echo $q;
    $result4 = $conn->query($q);
    
    if ($result4->num_rows > 0) {
        // Fetch the data
        while ($row4 = $result4->fetch_assoc()) {
            $agencyid = $row4['agency_id'];
            $dor = $row4['date_of_request'];
            $doa = $row4['date_of_acceptance'];
           // echo $dor;
        }
    } else {
        echo "No rows found.";
    }
    
 $query5="INSERT INTO  lifting_invoice_status(tid,hks_id,agency_id,date_of_request,date_of_acceptance,date_of_lifting,quantity,invoice)VALUE('$trid','$hksid','$agencyid','$dor','$doa','$date','$quantity','no')";
 $result5 = $conn->query($query5);
 //echo $query5;

 $d="DELETE FROM lifting_pending  WHERE tid =$trid";
 $resultd = $conn->query($d);
 if($resultd){
    header('location:formsubmision.html');
 }
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Add your head content here -->
</head>
<body>

<div class="container mt-3">
    <form name="hksrequest" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" au   tocomplete="off">
    <div><center><h3><b>Actual Lifting Data Entry</b></h3></center></div>
    <div class="mb-3">
            <label for="trid" class="form-label"><b>Transaction ID</b></label>
            <input type="text" class="form-control" name="trid" required autocomplete="off" value="<?php echo $trid; ?>">
        </div>
    <div class="mb-3">
            <label for="date" class="form-label"><b>Date of Actual Lifting</b></label>
            <input type="date" class="form-control"  name="date" autocomplete="off" required value="<?php echo date('Y-m-d'); ?>">
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label"><b>Quantity of Lifting</b></label>
            <select name="quantity" class="form-select" required onchange="showFields(this.value)">
                <option value="">Select</option>
                <option value="fully">Fully</option>
                <option value="partially">Partially</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="driver" class="form-label"><b>Name of Driver</b></label>
            <input type="text" class="form-control" name="driver" required autocomplete="off">
        </div>
        <div class="mb-3">
            <label for="vehicleno" class="form-label"><b>Vehicle No</b></label>
            <input type="text" class="form-control" name="vehicleno" required autocomplete="off">
        </div>
        <div class="mb-3">
            <label for="lsgi" class="form-label"><b> Name of LSGI</b></label>
            <input type="text" class="form-control"  name="lsgi" required autocomplete="off" value="<?php echo $hksname; ?>">
        </div>
        <div class="mb-3">
            <label for="location" class="form-label"><b>Location Of Mcf</b></label>
            <input type="text" class="form-control"  name="location" required autocomplete="off" value="<?php echo $mcfloc; ?>">
        </div>

        <button type="submit" class="btn btn-primary"><b>Submit</b></button>
    </form>
</div>

<!-- Include Bootstrap JS and any other necessary scripts -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>
</html>

<?php

include('footer.html');
}
else{
    header('Location:..\Login-System\login\index.php');
}
?>















