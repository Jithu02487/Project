<?php



session_start();

$v1id=$_SESSION['v1id'];

if(isset($_SESSION['v1id'])){

include ("header.html");

// add lbid into mcf table +++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$host = "localhost";

$servername = "localhost";

$username = "dbUser";

$password = "dbPassword";

$dbname = "forward_linkage";

$conn = new mysqli($servername, $username, $password, $dbname);

$l = "select lb_id from verifier_one where v1id =$v1id";

$r = $conn->query($l);

// echo$l;

if ($r !== false) {

    if ($r->num_rows > 0) {

        $ro = $r->fetch_assoc();

        $lbid = $ro['lb_id'];

    }

} else {

    die("Error in query execution: " . $conn->error);

}

if(isset($_POST["submit"])){

try {

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    $sql = "INSERT INTO mcf ( ownership, location, area, weighingMachine, fireExtinguisher, fireNOC, lastFireAuditDate, electricConnection, waterConnection, toilet, fan, changingRoom, balingMachine, shreddingUnit, vehicleForHKS, noOfVehiclesForHKS, agencyName, agreementPeriod, fromDate, toDate,lb_id,hksid,v1id) 

            VALUES ( :ownership, :location, :area, :weighingMachine, :fireExtinguisher, :fireNOC, :lastFireAuditDate, :electricConnection, :waterConnection, :toilet, :fan, :changingRoom, :balingMachine, :shreddingUnit, :vehicleForHKS, :noOfVehiclesForHKS, :agencyName, :agreementPeriod, :fromDate, :toDate,'$lbid',:hksid,'$v1id')";



    $stmt = $pdo->prepare($sql);



    // Replace $_POST with your actual form data variables

    // $stmt->bindParam(':noOfMCF', $_POST['noOfMCF']);

    $stmt->bindParam(':hksid', $_POST['hksname']);

    $stmt->bindParam(':ownership', $_POST['ownership']);

    $stmt->bindParam(':location', $_POST['location']);

    $stmt->bindParam(':area', $_POST['area']);

    $stmt->bindParam(':weighingMachine', $_POST['weighingMachine']);

    $stmt->bindParam(':fireExtinguisher', $_POST['fireExtinguisher']);

    $stmt->bindParam(':fireNOC', $_POST['fireNOC']);

    $stmt->bindParam(':lastFireAuditDate', $_POST['lastFireAuditDate']);

    $stmt->bindParam(':electricConnection', $_POST['electricConnection']);

    $stmt->bindParam(':waterConnection', $_POST['waterConnection']);

    $stmt->bindParam(':toilet', $_POST['toilet']);

    $stmt->bindParam(':fan', $_POST['fan']);

    $stmt->bindParam(':changingRoom', $_POST['changingRoom']);

    $stmt->bindParam(':balingMachine', $_POST['balingMachine']);

    $stmt->bindParam(':shreddingUnit', $_POST['shreddingUnit']);

    $stmt->bindParam(':vehicleForHKS', $_POST['vehicleForHKS']);

    $stmt->bindParam(':noOfVehiclesForHKS', $_POST['noOfVehiclesForHKS']);

    $stmt->bindParam(':agencyName', $_POST['agencyName']);

    $stmt->bindParam(':agreementPeriod', $_POST['agreementPeriod']);

    $stmt->bindParam(':fromDate', $_POST['fromDate']);

    $stmt->bindParam(':toDate', $_POST['toDate']);



    $stmt->execute();



    // Redirect to a success page or do something else after successful insertion

   header("Location: formsubmision.html");

    exit();

} catch (PDOException $e) {

    echo 'Error: ' . $e->getMessage();

}

}





?> 




<!DOCTYPE html>

<html>

<head>

    <style>

        .bg-color{

            background: "white";

        }

    </style>



    

    <!-- Include Bootstrap CSS (you might need to download and host it locally or use a CDN) -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Collection Form</title>

    <!-- Include Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body class="bg-color">

    <div class="container mt-5">

        <h2>MCF Data Collection</h2>

        <body class="container mt-5">

    



    <form action="mcf.php" method="post">

    

    <div class="mb-3">

    <label for="hksname">HKS Name:</label>

    <select class="form-control" id="hksname" name="hksname" required>

    <option>---Select---</option>

    

    <?php

    $h = "SELECT id, hks_name FROM hks WHERE v1id='$v1id'";

    $r = $conn->query($h);



    if ($r->num_rows > 0) {

        while ($row = $r->fetch_assoc()) {

            echo '<option value="' . $row['id'] . '">' . $row['hks_name'] . '</option>';

        }

    } else {

        echo "No HKS records found.";

    }

    ?>

</select>



</div>

        



        <div class="mb-3">

    <label for="ownership">Own/Rental:</label>

    <select class="form-control" id="ownership" name="ownership" required>

        <option>---Select--</option>

        <option value="own">Own</option>

        <option value="rental">Rental</option>

    </select>

</div>







        <div class="mb-3">

            <label for="location"> Location of MCF:</label>

            <input type="text" class="form-control" id="location" name="location" required>

        </div>



        <div class="mb-3">

            <label for="area"> Area of MCF (Meter Square):</label>

            <input type="text" class="form-control" id="area" name="area" required>

        </div>



        <div class="mb-3">

            <label for="weighingMachine"> Weighing Machine (YES/NO):</label>

            <input type="text" class="form-control" id="weighingMachine" name="weighingMachine" required>

        </div>



        <div class="mb-3">

            <label for="fireExtinguisher"> Fire Extinguisher (YES/NO):</label>

            <input type="text" class="form-control" id="fireExtinguisher" name="fireExtinguisher" required>

        </div>



        <div class="mb-3">

            <label for="fireNOC"> Fire NOC Availed (YES/NO):</label>

            <input type="text" class="form-control" id="fireNOC" name="fireNOC" required>

        </div>



        <div class="mb-3">

            <label for="lastFireAuditDate">Last Fire Audit Date:</label>

            <input type="date" class="form-control" id="lastFireAuditDate" name="lastFireAuditDate" required>

        </div>



        <div class="mb-3">

            <label for="electricConnection">Electric Connection (YES/NO):</label>

            <input type="text" class="form-control" id="electricConnection" name="electricConnection" required>

        </div>



        <div class="mb-3">

            <label for="waterConnection">Water Connection (YES/NO):</label>

            <input type="text" class="form-control" id="waterConnection" name="waterConnection" required>

        </div>



        <div class="mb-3">

            <label for="toilet"> Toilet (YES/NO):</label>

            <input type="text" class="form-control" id="toilet" name="toilet" required>

        </div>



        <div class="mb-3">

            <label for="fan"> Fan (YES/NO):</label>

            <input type="text" class="form-control" id="fan" name="fan" required>

        </div>



        <div class="mb-3">

            <label for="changingRoom"> Dress Changing Room (YES/NO):</label>

            <input type="text" class="form-control" id="changingRoom" name="changingRoom" required>

        </div>



        <div class="mb-3">

            <label for="balingMachine"> Functional Baling Machine (YES/NO):</label>

            <input type="text" class="form-control" id="balingMachine" name="balingMachine" required>

        </div>



        <div class="mb-3">

            <label for="shreddingUnit">Functional Shredding Unit (YES/NO):</label>

            <input type="text" class="form-control" id="shreddingUnit" name="shreddingUnit" required>

        </div>



        <div class="mb-3">

            <label for="vehicleForHKS">Vehicle for HKS (YES/NO):</label>

            <input type="text" class="form-control" id="vehicleForHKS" name="vehicleForHKS" required>

        </div>



        <div class="mb-3">

            <label for="noOfVehiclesForHKS"> Number of Vehicles for HKS:</label>

            <input type="text" class="form-control" id="noOfVehiclesForHKS" name="noOfVehiclesForHKS" required>

        </div>



        <div class="mb-3">

            <label for="agencyName"> Name of Agency Having Agreement With:</label>

            <input type="text" class="form-control" id="agencyName" name="agencyName" required>

        </div>



        <div class="mb-3">

            <label for="agreementPeriod"> Agreement Period:</label>

            <input type="date" class="form-control" id="agreementPeriod" name="agreementPeriod" required>

        </div>



        <div class="mb-3">

            <label for="fromDate">From Date:</label>

            <input type="date" class="form-control" id="fromDate" name="fromDate" required>

        </div>



        <div class="mb-3">

            <label for="toDate"> To Date:</label>

            <input type="date" class="form-control" id="toDate" name="toDate" required>

        </div><br>



        <!-- Add more fields as needed -->

        <div class="mb-3">



        <button type="submit" name="submit" class="btn btn-primary">Submit</button>

    </div>

    </form>

    </div>



    <!-- Include Bootstrap JS (you might need to download and host it locally or use a CDN) -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- <script>

        function showFields(value) {

            const segregatedFields = document.querySelectorAll("#segregated_fields");

            const mixedFields = document.querySelectorAll("#mixed_fields");



            if (value === "Segregated") {

                segregatedFields.forEach((field) => field.style.display = "block");

                mixedFields.forEach((field) => field.style.display = "none");

            } else if (value === "Mixed") {

                segregatedFields.forEach((field) => field.style.display = "none");

                mixedFields.forEach((field) => field.style.display = "block");

            } else {

                segregatedFields.forEach((field) => field.style.display = "none");

                mixedFields.forEach((field) => field.style.display = "none");

            }

        }

    </script> -->
    <?php

include('footer.html');

}

else{

    header('Location:..\Login-System\login\index.php');

}

?>
</body>
</html>