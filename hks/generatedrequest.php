<?php 
include("../connection/connection.php");
include('hkssession.php');
if(isset($_SESSION['id'])){
include("headerhks.html");
// Fetch data from the database
$sql = "select * from hks_request where hksid=$hksid";
$result = $conn->query($sql);
// echo"$result";

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
            <th>SL.NO</th> <!-- Fixed the closing th tag here -->
            <!-- <th>RequestID</th> -->
            <th>Date Of Submission</th> <!-- Moved the Date heading to the correct position -->
            <th>Type</th>
            <th>Weight</th>
            <th>Status</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {$i=1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr class='white-row'>";
                echo "<td class='center'>" .$i . "</td>";
                echo "<td class='center'>" . $row["date"] . "</td>";
                echo "<td class='center'>" . $row["type"] . "</td>";
                echo "<td class='center'>" . $row["weight"] . "</td>";
                if($row["trackid"]==0)
                {
                    $r="Waiting For Approval of Verifier_One";
                }
                    // echo "<td class='center' >Waiting For Approval of Verifier_One<td>";}
                if($row["trackid"]==1){
                    $r="Waiting For Approval of Verifier_Two";
                }
                if($row["trackid"]==2){
                    $r="Approved by  Verifier_Two";
                }
                echo "<td class='center'>" . $r . "</td>";
                echo "</tr>";
                $i=$i+1;
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