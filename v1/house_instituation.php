<?php
include("../connection/connection.php");
include('v1session.php');
if(isset($_SESSION['v1id'])){
include("header.html");

$query = "SELECT lb.id FROM localbody lb 
          INNER JOIN verifier_one v ON v.lb_id = lb.id 
          WHERE v.v1id = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $v1id); // Assuming $v1id is an integer, adjust the type accordingly
$stmt->execute();
$result = $stmt->get_result();
//echo $query;
// Check if the query executed successfully
if (!$result) {
    die("Query failed: " . $conn->error);
} else {
    // Check if any rows were returned
    if ($result->num_rows > 0) {
        // Fetch the data
        while ($row = $result->fetch_assoc()) {
            $lbid = $row['id'];
        }
    } else {
        echo "No rows found.";
    }
    
    // Free the result set
    $result->free();
}
///////////////////////////////////////////////
echo"<!DOCTYPE html>";
echo"<html lang='en'>";
echo"<head>";
    echo"<meta charset='UTF-8'>";
    echo"<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo"<title>Bootstrap Form</title>";
    echo"<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>";
echo"</head>";
echo"<body>";
///////////////////////////////////////////////
$q = "SELECT * FROM fixed_data WHERE lb_id = ?";

$stmt = $conn->prepare($q);
$stmt->bind_param("i", $lbid); // Assuming $lbid is an integer, adjust the type accordingly
$stmt->execute();
$res = $stmt->get_result();
//echo $query;
// Check if the query executed successfully
if (!$res) {
    die("Query failed: " . $conn->error);
} else {
    // Check if any rows were returned
    if ($res->num_rows > 0) {
        // Fetch the data
        while ($r = $res->fetch_assoc()) {
            echo"<div class='container mt-3'>";
            echo"<br><label for='wards'>Number Of Wards :";echo $r['no_of_wards'];echo"</label>";
            echo"<br><label for='wards'>Number Of HKS Members :"; echo $r['no_of_hksm'];echo"</label>";
            echo"<br><label for='wards'>Number Of Mini MCF :"; echo $r['no_of_mini_mcf'];echo"</label>";
            echo"<br><label for='wards'>Number Of Active Houses :"; echo $r['active_house'];echo"</label>";
            echo"<br><label for='wards'>Amount From a House :"; echo $r['amount_house'];echo"</label>";
            echo"<br><label for='wards'>Number Of Institution :";echo $r['no_of_instituation'];echo"</label>";
            echo"<br><label for='wards'>Number of Active Institution :"; echo $r['active_instituation'];echo"</label>";
            echo"<br><label for='wards'>Amount From an Institution :";echo $r['amount_instituation'];echo"</label>";
                
                echo"<br>";
                echo"<br>";
                echo"<button type='submit' class='btn btn-primary'>Update Request</button>";
        echo"</div>";
        
        echo"<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>";
        echo"<script>";
            // Your JavaScript code (addSelectedItem and submitForm functions) goes here
        echo"</script>";

        }
    } else {
        echo"<div class='container mt-3'>";
        echo"<form id='dataForm' method=post>";
        echo"<br><label for='wards'>Number Of Wards</label>";
            echo"<input type='number' name='wards' class='form-control' required>";
    
            echo"<br><label for='hksm'>Number Of HKS Members</label>";
            echo"<input type='number' name='hksm' class='form-control' required>";
    
            echo"<br><label for='minimmcf'>Number Of Mini MCF</label>";
            echo"<input type='number' name='mcf' class='form-control' required>";
    
            echo"<br><label for='house'>Total number of house</label>";
            echo"<input type='number' name='house' class='form-control' required>";
    
            echo"<br><label for='ahouse'>Number Of Active Houses</label>";
            echo"<input type='number' name='ahouse' class='form-control' required>";
            echo"<br><label for='hamount'>Amount From House</label>";
            echo"<input type='number' name='ahamount' class='form-control' required>";
            echo"<br><label for='inst'>Total Number Of Instituation</label>";
            echo"<input type='number' name='inst' class='form-control' required>";
            echo"<br><label for='ainst'>Number Of Active Instituation</label>";
            echo"<input type='number' name='ainst' class='form-control' required>";
            echo"<br><label for='iamount'>Amount From Institustion</label>";
            echo"<input type='number' name='ihamount' class='form-control' required>";
           
            echo"<br>";
            echo"<br>";
            echo"<button type='submit' class='btn btn-primary'>Submit</button>";
    
            
       echo" </form>";
    echo"</div>";
    
    echo"<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>";
    echo"<script>";
        // Your JavaScript code (addSelectedItem and submitForm functions) goes here
    echo"</script>";
    }
    
    // Free the result set
    $res->free();
}

//////////////////////////////////////////////
         // Handle form submission 
    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        // Retrieve form data 
       
        $wards = $_POST["wards"]; 
        $hksm = $_POST["hksm"]; 
        $mcf = $_POST["mcf"]; 
        $house = $_POST["house"]; 
        $ahouse = $_POST["ahouse"];
        $ahamount = $_POST["ahamount"];
        $inst = $_POST["inst"];
        $ainst = $_POST["ainst"];
        $ihamount = $_POST["ihamount"];

        // Prepare and execute the SQL statement 
        $sql = "INSERT INTO fixed_data (lb_id, no_of_wards, no_of_hksm, no_of_mini_mcf, no_of_house, active_house, amount_house, no_of_instituation, active_instituation, amount_instituation) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiiiiiiiii", $lbid, $wards, $hksm, $mcf, $house, $ahouse, $ahamount, $inst, $ainst, $ihamount);
        if ($stmt->execute()) { 
            echo "Form data successfully stored in the database."; 
        } else { 
            echo "Error: " . $stmt->error; 
        } 
     
        // Close the statement 
        $stmt->close(); 
    } 
     
    // Close the database connection 

    ?>






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
?>