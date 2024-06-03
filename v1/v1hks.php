<?php 

include("../connection/connection.php");
include('v1session.php');
if(isset($_SESSION['v1id'])){
include("header.html");
// Fetch data from the database
$sql = "select hks.hks_name,hks.hks_email,hks.account_no,hks.ifsc,hks_user.president,hks_user.president_contact,hks_user.secretary,hks_user.secretary_contact from hks join hks_user on hks.id=hks_user.hksid where hks.v1id='$v1id'";
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
            <th>HKS</th> <!-- Moved the Date heading to the correct position -->
            <th>Email id</th>
            <th>ACCount NO</th>
            <th>IFSC Code</th>
            <th>President</th>
            <th>Contact No</th>
            <th>Secretary</th>
            <th>Contact No</th>
        </tr>
        <?php
        if (!$result) {
            echo "Error: " . $conn->error;
        } else {
            // Continue with processing the result set
            if ($result->num_rows > 0) {
            
            $i=1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr class='white-row'>";
                echo "<td class='center'>" .$i . "</td>";
                echo "<td class='center'>" . $row["hks_name"] . "</td>";
                echo "<td class='center'>" . $row["hks_email"] . "</td>";
            
                echo "<td class='center'>" . $row["account_no"] . "</td>";
                echo "<td class='center'>" . $row["ifsc"] . "</td>";
                echo "<td class='center'>" . $row["president"] . "</td>";
                echo "<td class='center'>" . $row["president_contact"] . "</td>";
                echo "<td class='center'>" . $row["secretary"] . "</td>";
                echo "<td class='center'>" . $row["secretary_contact"] . "</td>";
                echo "</tr>";
                $i=$i+1;
            }
        }
        
    
        else {
            echo "Details Will be Displayed After Adding Consortium Details ";
        }
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