<?php
include("../connection/connection.php");
include('v1session.php');
if(isset($_SESSION['v1id'])){
include("header.html");
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Retrieve form data 
   
    $hksname= $_POST["hksname"]; 
    $email = $_POST["hksemail"];
    $acno = $_POST["acno"];
    $ifsc = $_POST["ifsc"];

    // Prepare and execute the SQL statement 
   // Prepare and execute the SQL statement
$sql = "INSERT INTO hks (hks_name, hks_email,account_no, ifsc, v1id) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo "Error: " . $conn->error;
} else {
    // Bind parameters and execute the statement
    $stmt->bind_param("sssss", $hksname, $email, $acno, $ifsc, $v1id);
    
    if ($stmt->execute()) {
        //echo "Form data successfully stored in the database.";
        header('location:formsubmision.html');
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

} 
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-3">
    <form id="dataForm" method=post>
    <br><label for="hvisited">Name of HKS</label>
        <input type="text" name="hksname" class="form-control" required>

        <br><label for="ah">HKS Email</label>
        <input type="email" name="hksemail" class="form-control" required>

        <br><label for="ivisited">Account Number</label>
        <input type="number" name="acno" class="form-control" required>

        <br><label for="house">IFSC Code</label>
        <input type="text" name="ifsc" class="form-control" required>
        <br>
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>

        
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Your JavaScript code (addSelectedItem and submitForm functions) goes here
</script>

</body>
</html>


    
</body>

</html>
<?php
include('footer.html');
    }
    else{
        header('Location:..\Login-System\login\index.php');
    }
    ?>