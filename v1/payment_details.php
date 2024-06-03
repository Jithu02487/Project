<?php
include("../connection/connection.php");
include('v1session.php');
if(isset($_SESSION['v1id'])){
include("header.html");
if (isset($_GET['id'])) {
    // Retrieve the ID from the URL
    $trid = $_GET['id'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $date = $_POST["dateOfPayment"];
    $utr = $_POST["utr"];

    $q = "UPDATE lifting_invoice_status SET payment = 'yes', date_of_payment = ?, utr = ? WHERE tid = ?";

    $stmt = $conn->prepare($q);
    $stmt->bind_param("sss", $date, $utr, $trid);
    $resultt = $stmt->execute();
    if (!$resultt) {
        die("Error: " . $conn->error);
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Payment Information Form</title>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Payment Information Form</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post">
                <div class="mb-3">
                    <label for="dateOfPayment" class="form-label">Date of Payment:</label>
                    <input type="date" class="form-control" id="dateOfPayment" name="dateOfPayment" required>
                </div>

                <div class="mb-3">
                    <label for="utr" class="form-label">UTR:</label>
                    <input type="text" class="form-control" id="utr" name="utr" placeholder="Enter UTR" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
include('footer.html');
}
else{
    header('Location:..\Login-System\login\index.php');
}
?>