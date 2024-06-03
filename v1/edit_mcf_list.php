<?php



session_start();

$v1id=$_SESSION['v1id'];

if(isset($_SESSION['v1id'])){

    include('header.html');

$host = "localhost";

$username = "dbUser";

$password = "dbPassword";

$dbname = "forward_linkage";



try {

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    echo 'Error connecting to the database: ' . $e->getMessage();

    exit();

}



if (isset($_GET['id'])) {

    $mcfId = $_GET['id'];



    try {

        $sql = "SELECT * FROM mcf WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':id', $mcfId, PDO::PARAM_INT);

        $stmt->execute();

        $mcfData = $stmt->fetch(PDO::FETCH_ASSOC);



        if (!$mcfData) {

            echo 'MCF data not found.';

            exit();

        }

    } catch (PDOException $e) {

        echo 'Error fetching MCF data: ' . $e->getMessage();

        exit();

    }

} else {

    // Redirect to the MCF list page if no ID is provided

   // header("Location: mcf_list.php");

    exit();

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    // Get data from the form

    $mcfId = $_POST['Id'];

    $noOfMCF = $_POST['noOfMCF'];

    $ownership = $_POST['ownership'];

    $location = $_POST['location'];

    $area = $_POST['area'];

    $weighingMachine= $_POST['weighingMachine'];

    $fireExtinguisher= $_POST['fireExtinguisher'];

    $fireNOC= $_POST['fireNOC'];

    $lastFireAuditDate= $_POST['lastFireAuditDate'];

    $electricConnection= $_POST['electricConnection'];

    $waterConnection= $_POST['waterConnection'];

    $toilet= $_POST['toilet'];

    $fan= $_POST['fan'];

    $changingRoom= $_POST['changingRoom'];

    $balingMachine= $_POST['balingMachine'];

    $shreddingUnit= $_POST['shreddingUnit'];

    $vehicleForHKS= $_POST['vehicleForHKS'];

    $noOfVehiclesForHKS= $_POST['noOfVehiclesForHKS'];

    $agencyName= $_POST['agencyName'];

    $agreementPeriod= $_POST['agreementPeriod'];

    $fromDate= $_POST['fromDate'];

    $toDate= $_POST['toDate'];

    // Add more fields as needed



    try {

        // Update MCF data in the database

        $sql = "UPDATE mcf SET noOfMCF = :noOfMCF, ownership = :ownership, location = :location,

        area = :area,weighingMachine=:weighingMachine,fireExtinguisher=:fireExtinguisher,fireNOC = :fireNOC,lastFireAuditDate = :lastFireAuditDate, electricConnection = :electricConnection, 

        waterConnection = :waterConnection,toilet = :toilet,fan = :fan,changingRoom = :changingRoom,balingMachine = :balingMachine,shreddingUnit = :shreddingUnit,vehicleForHKS = :vehicleForHKS,

        noOfVehiclesForHKS = :noOfVehiclesForHKS,agencyName = :agencyName,agreementPeriod = :agreementPeriod,fromDate = :fromDate,toDate = :toDate WHERE mcfid = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':id', $mcfId, PDO::PARAM_INT);

        $stmt->bindParam(':noOfMCF', $_POST['noOfMCF']);

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

        // Bind more parameters for other fields



        $stmt->execute();



        // Redirect to the MCF list page after successful update

        header("Location: mcf_list.php");

        exit();

    } catch (PDOException $e) {

        echo 'Error updating MCF data: ' . $e->getMessage();

        exit();

    }

} 









?>



<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit MCF Data</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

</head>

<body>



<div class="container mt-5">

    <h2>Edit MCF Data</h2>

    <form action="update_mcf.php" method="post">

        <input type="hidden" name="mcfId" value="<?php echo $mcfData['id']; ?>">



        <!-- Number of MCF -->

        <!-- <div class="mb-3">

            <label for="noOfMCF" class="form-label">Number of MCF:</label>

            <input type="text" class="form-control" id="noOfMCF" name="noOfMCF" value="<?php // echo $mcfData['noOfMCF']; ?>" required>

        </div> -->



        <!-- Ownership -->

        <div class="mb-3">

            <label for="ownership" class="form-label">Ownership:</label>

            <input type="text" class="form-control" id="ownership" name="ownership" value="<?php echo $mcfData['ownership']; ?>" required>

        </div>



        <!-- Location -->

        <div class="mb-3">

            <label for="location" class="form-label">Location:</label>

            <input type="text" class="form-control" id="location" name="location" value="<?php echo $mcfData['location']; ?>" required>

        </div>



        <!-- Area -->

        <div class="mb-3">

            <label for="area" class="form-label">Area:</label>

            <input type="text" class="form-control" id="area" name="area" value="<?php echo $mcfData['area']; ?>" required>

        </div>



        <!-- Weighing Machine -->

        <div class="mb-3">

            <label for="weighingMachine" class="form-label">Weighing Machine (YES/NO):</label>

            <input type="text" class="form-control" id="weighingMachine" name="weighingMachine" value="<?php echo $mcfData['weighingMachine']; ?>" required>

        </div>



        <!-- Fire Extinguisher -->

        <div class="mb-3">

            <label for="fireExtinguisher" class="form-label">Fire Extinguisher (YES/NO):</label>

            <input type="text" class="form-control" id="fireExtinguisher" name="fireExtinguisher" value="<?php echo $mcfData['fireExtinguisher']; ?>" required>

        </div>



        <div class="mb-3">

            <label for="fireNOC"> Fire NOC Availed (YES/NO):</label>

            <input type="text" class="form-control" id="fireNOC" name="fireNOC" required value="<?php echo $mcfData['fireNOC']; ?>">

        </div>



        <div class="mb-3">

            <label for="lastFireAuditDate">Last Fire Audit Date:</label>

            <input type="date" class="form-control" id="lastFireAuditDate" name="lastFireAuditDate" value="<?php echo $mcfData['lastFireAuditDate']; ?>"required>

        </div>



        <div class="mb-3">

            <label for="electricConnection">Electric Connection (YES/NO):</label>

            <input type="text" class="form-control" id="electricConnection" name="electricConnection" value="<?php echo $mcfData['electricConnection']; ?>"required>

        </div>



        <div class="mb-3">

            <label for="waterConnection">Water Connection (YES/NO):</label>

            <input type="text" class="form-control" id="waterConnection" name="waterConnection" value="<?php echo $mcfData['waterConnection']; ?>" required>

        </div>



        <div class="mb-3">

            <label for="toilet"> Toilet (YES/NO):</label>

            <input type="text" class="form-control" id="toilet" name="toilet"  value="<?php echo $mcfData['toilet']; ?>"required>

        </div>



        <div class="mb-3">

            <label for="fan"> Fan (YES/NO):</label>

            <input type="text" class="form-control" id="fan" name="fan" value="<?php echo $mcfData['fan']; ?>"required>

        </div>



        <div class="mb-3">

            <label for="changingRoom"> Dress Changing Room (YES/NO):</label>

            <input type="text" class="form-control" id="changingRoom" name="changingRoom" value="<?php echo $mcfData['changingRoom']; ?>"required>

        </div>



        <div class="mb-3">

            <label for="balingMachine"> Functional Baling Machine (YES/NO):</label>

            <input type="text" class="form-control" id="balingMachine" name="balingMachine" value="<?php echo $mcfData['balingMachine']; ?>" required>

        </div>



        <div class="mb-3">

            <label for="shreddingUnit">Functional Shredding Unit (YES/NO):</label>

            <input type="text" class="form-control" id="shreddingUnit" name="shreddingUnit" value="<?php echo $mcfData['shreddingUnit']; ?>"required>

        </div>



        <div class="mb-3">

            <label for="vehicleForHKS">Vehicle for HKS (YES/NO):</label>

            <input type="text" class="form-control" id="vehicleForHKS" name="vehicleForHKS"  value="<?php echo $mcfData['vehicleForHKS']; ?>"required>

        </div>



        <div class="mb-3">

            <label for="noOfVehiclesForHKS"> Number of Vehicles for HKS:</label>

            <input type="text" class="form-control" id="noOfVehiclesForHKS" name="noOfVehiclesForHKS" value="<?php echo $mcfData['noOfVehiclesForHKS']; ?>" required>

        </div>



        <div class="mb-3">

            <label for="agencyName"> Name of Agency Having Agreement With:</label>

            <input type="text" class="form-control" id="agencyName" name="agencyName" value="<?php echo $mcfData['agencyName']; ?>" required>

        </div>



        <div class="mb-3">

            <label for="agreementPeriod"> Agreement Period:</label>

            <input type="date" class="form-control" id="agreementPeriod" name="agreementPeriod" value="<?php echo $mcfData['agreementPeriod']; ?>"required>

        </div>



        <div class="mb-3">

            <label for="fromDate">From Date:</label>

            <input type="date" class="form-control" id="fromDate" name="fromDate" value="<?php echo $mcfData['fromDate']; ?>" required>

        </div>



        <div class="mb-3">

            <label for="toDate"> To Date:</label>

            <input type="date" class="form-control" id="toDate" name="toDate" value="<?php echo $mcfData['toDate']; ?>" required>

        </div><br>



        <!-- Add more fields as needed -->

        <div class="mb-3">



        <button type="submit" name="submit" class="btn btn-primary">Submit</button>

    </div></form>

</div>



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

?>