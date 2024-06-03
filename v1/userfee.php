<?php

include("../connection/connection.php");

include('v1session.php');

if(isset($_SESSION['v1id'])){

include("header.html");



$query = "select lb.id,f.no_of_wards,f.no_of_hksm,f.no_of_mini_mcf,f.no_of_house,f.active_house,f.amount_house,f.no_of_instituation,f.active_instituation,f.amount_instituation from localbody lb INNER JOIN verifier_one v on v.lb_id=lb.id INNER JOIN fixed_data f ON f.lb_id=lb.id WHERE v.v1id=$v1id";

//echo$query;

$result = $conn->query($query);

//echo $query;

// Check if the query executed successfully

if (!$result) {

    die("Query failed: " . $conn->error);

} else {

    // Check if any rows were returned

    if ($result->num_rows > 0) {

        // Fetch the data

        while ($row = $result->fetch_array()) {

            $lbid = $row['id'];

            $wards = $row['no_of_wards']; 

            $hksm = $row['no_of_hksm'];

            $mcf = $row['no_of_mini_mcf']; 

            $house = $row['no_of_house']; 

            $ahouse = $row['active_house'];

            $ahamount = $row['amount_house'];

            $inst = $row['no_of_instituation'];

            $ainst = $row['active_instituation'];

            $ihamount = $row['amount_instituation'];

        }

    } else {

        echo "No rows found.";

    }

    

    // Free the result set

    $result->free();

}

         // Handle form submission 

    if ($_SERVER["REQUEST_METHOD"] == "POST") { 

        // Retrieve form data 

       

        $hvisited = $_POST["hvisited"]; 

        $ah = $_POST["ah"];

        $ivisited = $_POST["ivisited"];

        $ai = $_POST["ai"];



        // Prepare and execute the SQL statement 

        $sql = "INSERT INTO user_fee (date_of_entry, lb_id, no_of_wards, no_of_hksm, no_of_mini_mcf, amount_from_house, active_house, house_visited, collection_house, no_of_active_institution, institution_visited, collection_institution, number_of_house, number_of_institution, amount_form_institution) VALUES (CURDATE(), $lbid, $wards, $hksm, $mcf, $ah, $ahouse, $hvisited, $ahamount, $ainst, $ivisited, $ai, $house, $inst, $ihamount)"; 
        $result = $conn->query($query);

        

         

        // Execute the statement 

        if ($result) { 

            echo "Form data successfully stored in the database."; 

        } else { 

            echo "Error: " . $conn->error; 

        } 

     

        // Close the statement 

        $conn->close(); 

    } 

     

    // Close the database connection 



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

    <br><label for="hvisited">Number Of House Visited</label>

        <input type="number" name="hvisited" class="form-control" required>



        <br><label for="ah">Amount from House</label>

        <input type="number" name="ah" class="form-control" required>



        <br><label for="ivisited">Number Of Instituation Visited</label>

        <input type="number" name="ivisited" class="form-control" required>



        <br><label for="house">Amount From Instituation</label>

        <input type="number" name="ai" class="form-control" required>

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