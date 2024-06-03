<?php 
include("../connection/connection.php");
include('hkssession.php');
error_reporting(0);
// Check if the user is logged in
if(isset($_SESSION['id'])){
    include("headerhks.html");

    // Fetch data from the database
    $sql = "SELECT * FROM hks_request WHERE hksid=$hksid";
    $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="table.css">
    <title>Data Display</title>
</head>
<body>
    <table class="data-table">
        <tr>
            <th>SL.NO</th> <!-- Fixed the closing th tag here -->
            <th>Date Of Submission</th> <!-- Moved the Date heading to the correct position -->
            <th>Type</th>
            <th>Weight</th>
            <th>Status</th>
        </tr>
        <?php
        if($result){
            if ($result->num_rows > 0) {
            $i = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td class='center'>" .$i . "</td>";
                echo "<td class='center'>" . $row["date"] . "</td>";
                echo "<td class='center'>" . $row["type"] . "</td>";
                echo "<td class='center'>" . $row["weight"] . "</td>";
                $status = "";
                switch ($row["trackid"]) {
                    case 0:
                        $status = "Waiting For Approval of Verifier_One";
                        break;
                    case 1:
                        $status = "Waiting For Approval of Verifier_Two";
                        break;
                    case 2:
                        $status = "Approved by Verifier_Two";
                        break;
                    default:
                        $status = "Unknown";
                        break;
                }
                echo "<td class='center'>" . $status . "</td>";
                echo "</tr>";
                $i++;
            }
        } else {
            echo "<tr><td colspan='5' class='center'>No data found</td></tr>";
        }
    }else{
        // echo "<p>Error: " . $conn->error . "</p>";
        echo "<tr><td colspan='5' class='center'>Query failed: An error occurred while processing the request.</td></tr>";

    }
        // Close the database connection
        $conn->close();
        ?>
    </table>
</body>
</html>
<?php
} else {
    // Redirect to login page if user is not logged in
    header('Location:..\Login-System\login\index.php');
}
?>
