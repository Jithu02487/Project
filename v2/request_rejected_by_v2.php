<?php
// Start the session
include("../connection/connection.php");
include('v2session.php');
if(isset($_SESSION['id'])){
include("headerv2.html");


$tr_id;

if (isset($_GET['id'])) {
    $tr_id = $_GET['id'];
    $_SESSION['globalVar'] = $tr_id; // Store the value in the session
    
}

// Retrieve the value from the session
$globalVar = isset($_SESSION['globalVar']) ? $_SESSION['globalVar'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $remark = $_POST["remark"];
    function updateLinkClickDate($tr_id) {
        global $conn; // Access the global connection variable
    $q="select dataid from v1request_to_v2 where trid='$tr_id'";
    $result5 = $conn->query($q);
    if ($result5->num_rows > 0) {
        $row5 = $result5->fetch_assoc();
        $dataid = $row5['dataid'];}
        // Update the link_click_date column with the current date
        $sql ="UPDATE date SET v2date = CURRENT_DATE, v1dataid = '$dataid' WHERE trid = $tr_id";

    
        if ($conn->query($sql) === TRUE) {
            // echo "Date updated successfully";
        } else {
            echo "Error updating date: " . $conn->error;
        }
    }

    updateLinkClickDate($globalVar);
    // Update the 'remark' column in the 'v1request_to_v2' table
    $sql = "UPDATE v1request_to_v2 SET remark='$remark' WHERE trid='$globalVar'";
    $result = $conn->query($sql);
    $sql2 = "UPDATE v1request_to_v2 SET reject_status='1' WHERE trid='$globalVar'";
    $result2 = $conn->query($sql2);
    

    //echo $sql;

    if ($result and $result2) {
        echo '<div class="alert alert-success" role="alert">
                Remark Added and Rejected Successfully
              </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
                Error updating remark: ' . $conn->error . '
              </div>';
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... Your head section ... -->
</head>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add custom styles here */
        .form-group {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Add Remarks And Reject</h2>
        <!-- Your form should be placed here -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="remark">Remark:</label>
                <textarea class="form-control" id="remark" name="remark" rows="3" placeholder="Enter your remarks here" required></textarea>
                <small class="form-text text-muted">Max 300 characters</small>
            </div>
            <button type="submit" class="btn btn-danger">Reject Request</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

</html>
<?php
include("footer.html");
    }
    else{
        header('Location:..\Login-System\login\index.php');
    }
?>