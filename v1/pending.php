<!-- Makesure the verifier one id in sql -->
<?php
include("../connection/connection.php");
include('v1session.php');
if(isset($_SESSION['v1id'])){
include("header.html");

//$v1id = $_SESSION['v1id'];
//echo$v1id;
// Fetch data from the database
$sql = "SELECT * FROM hks_request 
        INNER JOIN mcf ON hks_request.mcfid = mcf.id 
        INNER JOIN verifier_one ON verifier_one.lb_id = mcf.lb_id 
        WHERE verifier_one.v1id = ? AND hks_request.trackid = '0'";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $v1id); // Assuming $v1id is an integer, adjust the type accordingly
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Error: " . $conn->error);
}

// Rest of your code...
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="table.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   

    <title>Data Display</title>
</head>
<body>
    <table class="data-table">
        <tr class="center"  >
            <!-- <th>ID</th>
            <th>HksID</th> -->
            <th>LSGI</th> <!-- Fixed the closing th tag here -->
            <!-- <th>RequestID</th> -->
            <th>Date</th> <!-- Moved the Date heading to the correct position -->
            <th>Weight</th>
            <th>Type</th>
            <th></th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr class='white-row'>";
                echo "<td class='center'>" . $row["hks_name"] . "</td>";
                echo "<td class='center'>" . $row["date"] . "</td>";
                echo "<td class='center'>" . $row["weight"] . " Kg   </td>";
                echo "<td class='center'>" . $row["type"] . "</td>";
                echo "<td class='center color'><a class='btn btn view-button' href='v1form1.php?id=". $row["tr_id"] ."'>Action</a></td>";
                echo "</tr>";
            }
        }
        

        else {
            echo "No data found";
        }
        $conn->close();
        ?>
    </table>
    <?php
include('footer.html');
}
else{
    header('Location:..\Login-System\login\index.php');
}
?>
</body>
</html>
