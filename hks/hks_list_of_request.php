<?php 
include("../connection/connection.php");
include('hkssession.php');
if(isset($_SESSION['id'])){
include("headerhks.html");

$sql = "SELECT * from lifting_pending JOIN hks on lifting_pending.hksid=hks.id JOIN hks_request on hks_request.tr_id=lifting_pending.tid  where hks.id=$hksid  and lifting_pending.tid not in(select trid from actual_lift)";
//echo $sql;  
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
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
            <th>SL.NO</th> 
            <th>Date Of Submission</th>
            <th>Type</th>
            <th>Weight</th>
            <th>Data entry</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            $i=1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr class='white-row'>";
                echo "<td class='center'>" .$i . "</td>";
                echo "<td class='center'>" . $row["date"] . "</td>";
                echo "<td class='center'>" . $row["type"] . "</td>";
                echo "<td class='center'>" . $row["weight"] . "</td>";
                echo "<td class='center color'><a class='btn btn view-button' href='hks_actual_lift_entry.php?id=". $row["tr_id"] ."'>Click hHere</a></td>";
        
                $i=$i+1;
            }
        } else {
            echo "<tr><td colspan='5' class='center'>No data found</td></tr>";
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
