<?php

include("../connection/connection.php");

include('v1session.php');

if(isset($_SESSION['v1id'])){

include("header.html");





if (isset($_GET['id'])) {

    $trid =$_GET['id'];

   // echo "ID from URL: " . $trid;

} else {

    echo "ID not found in the URL";

}





$query = "SELECT * 

          FROM lifting_invoice_status 

          JOIN actual_lift ON lifting_invoice_status.tid = actual_lift.trid 

          JOIN agency ON agency.id = lifting_invoice_status.agency_id 

          JOIN hks ON hks.id = lifting_invoice_status.hks_id 

          WHERE tid = ?";



$stmt = $conn->prepare($query);

$stmt->bind_param("i", $trid); // Assuming $trid is an integer, adjust the type accordingly

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

            $doa = $row['date_of_lifting'];

            $driver = $row['driver_name'];

            $vehicleno = $row['vehicle_no'];

            $agency_name = $row['name'];

            $hksname = $row['hks_name'];

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

       

        $invoiceNumber = $_POST["invoice_number"]; 

        $invoiceDate = $_POST["invoice_date"]; 

        $amountToAgency = $_POST["amount_to_agency"]; 

        $amountToHKS = $_POST["amount_to_hks"]; 

     

        // File upload handling 

        $uploadDirectory = "uploads/";  // Specify your upload directory 

        $uploadedFile = $uploadDirectory . basename($_FILES["invoice_pdf"]["name"]); 

     

        if (move_uploaded_file($_FILES["invoice_pdf"]["tmp_name"], $uploadedFile)) { 

            echo "File successfully uploaded."; 

        } else { 

            echo "Error uploading file."; 

        } 

     

        // Prepare and execute the SQL statement 

        $sql = "INSERT INTO lifting_data ( invoice_number, invoice_date, amount_to_agency, amount_to_hks, lsgi_name, agency_name, invoice_pdf) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; 

        $stmt = $conn->prepare($sql); 

        $stmt->bind_param("ssssssssss", $liftingDate, $driverName, $vehicleNumber, $invoiceNumber, $invoiceDate, $amountToAgency, $amountToHKS, $lsgiName, $agencyName, $uploadedFile); 

         

        // Execute the statement 

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

    <form id="dataForm" method="post" action="process1.php" enctype="multipart/form-data" >

        <input type="hidden" value="<?php echo $trid;?>" name= "trid" id="trid">

        <br><label for="Date of Actual Lifting">Date of Actual Lifting</label>

        <input type="date" name="lifting_date" class="form-control" required value="<?php echo $doa; ?>">



        <br><label for="Name of Driver">Name of Driver</label>

        <input type="text" name="driver_name" class="form-control" required value="<?php echo $driver; ?>">



        <br><label for="Vehicl_No">Vehicl_No</label>

        <input type="text" name="vehicle_number" class="form-control" required value="<?php echo $vehicleno; ?>">



        

        <?php

       $r = "SELECT type FROM hks_request WHERE tr_id = ?";

       $stmt = $conn->prepare($r);

       $stmt->bind_param("i", $trid); // Assuming $trid is an integer, adjust the type accordingly

       $stmt->execute();

       $result = $stmt->get_result();

       

       if (!$result) {

           die("Error: " . $conn->error);

       }

       

       // Check if the query was successful

       if ($result) {

           // Fetch the data

           $row = $result->fetch_assoc();

           $type = $row['type'];

       

           // Close the result set

           $result->close();

       }

       $sql3 = "SELECT waste_id,waste_name  FROM waste";

       $result3 = $conn->query($sql3);

        // Replace this with your actual variable value



// if ($type == "Mixed") {

//     echo '<br><label for="dropdown">Select an item:</label>

//         <select id="dropdown" name="dropdown" class="form-select">

//             <option value="item1">Item 1</option>

//             <option value="item2">Item 2</option>

//             <option value="item3">Item 3</option>

//             <!-- Add more options as needed -->

//         </select>

        

//         <br><label for="value">Enter a value:</label>

//         <input type="text" id="value" name="value" class="form-control" required>

        

//         <button type="button" onclick="addSelectedItem()" class="btn btn-secondary">Add</button>

//         <button type="button" onclick="return sendSelectedItemsToPHP()" class="btn btn-success">Submit</button>';

// } 

if($type=="Mixed"){

    echo '<br><label for="dropdown">Select an item:</label>

    <select id="dropdown" name="dropdown" class="form-select">

    <option>----Select----</option>';

    if ($result3->num_rows > 0) {

        // Output data of each row

        while ($row3= $result3->fetch_assoc()) {

            // Generate option element dynamically

            echo '<option value="' . $row3["waste_name"] . '">' . $row3["waste_name"] . '</option>';

        }

    }

    echo'<br><label for="value">Enter a value:</label>

    <input type="text" id="value" name="value" class="form-control" placeholder="enter weight" required>

    <button type="button" onclick="addSelectedItem()" class="btn btn-secondary">Add</button>

    <button type="button" onclick="return sendSelectedItemsToPHP()" class="btn btn-success">Submit</button>';

}

?>





        <ul id="selectedItemsList" class="list-group mt-3"></ul>

    <br><label for="upliftedquantity">Quantity Uplifted</label>

        <input type="number" name="upliftedquantity" class="form-control" required>



        <input type="hidden" value="<?php echo $type;?>" name= "type" id="type">



        <br><label for="invoice_number">Invoice Number</label>

        <input type="text" name="invoice_number" class="form-control" required>



        <br><label for="invoice_date">Invoice Date</label>

        <input type="date" name="invoice_date" class="form-control" required>



        <br><label for="amount_to_hks">Amount to HKS</label>

        <input type="number" name="amount_to_hks" class="form-control" required>



        <br><label for="invoice_pdf">Upload Invoice (PDF Format)</label>

        <input type="file" name="invoice_pdf" class="form-control" accept=".pdf" required>



       <br> Name of LSGI

        <input type="text" name="lsgi_name" class="form-control" required value="<?php echo $agency_name; ?>">



        <br>Name of Agency

        <input type="text" name="agency_name" class="form-control" required value="<?php echo $hksname; ?>">



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





    <script>

        var selectedItems = [];

        var dropdown = document.getElementById("dropdown");

        var valueInput = document.getElementById("value");

        var selectedItemsList = document.getElementById("selectedItemsList");

        var trid = document.getElementById("trid").value;

        function addSelectedItem() {

            var selectedOption = dropdown.options[dropdown.selectedIndex].value;

            var value = valueInput.value;



            if (selectedItems.every(item => item.dropdown_item !== selectedOption)) {

                // Add the selected item to the array

                selectedItems.push({ dropdown_item: selectedOption, value: value });



                // Create a list item to display the selected item and value

                var listItem = document.createElement("li");

                listItem.textContent = `${selectedOption}: ${value}`;

                selectedItemsList.appendChild(listItem);

            }

            // Clear the value input

            valueInput.value = "";

        }



        // seding list to insert to the database

        function sendSelectedItemsToPHP() {

            console.log("Button clicked!");



            // Assuming you have a JavaScript variable 'trid'

            var trid = document.getElementById('trid').value;



            // Create a new XMLHttpRequest object

            var xhr = new XMLHttpRequest();



            // Specify the request type and URL

            xhr.open("POST", "process.php", true);



            // Set the Content-Type header for JSON data

            xhr.setRequestHeader("Content-Type", "application/json");



            // Convert the selectedItems array to JSON

            var jsonSelectedItems = JSON.stringify({ selectedItems: selectedItems, trid: trid });



            xhr.onreadystatechange = function () {

                if (xhr.readyState == 4) {

                    if (xhr.status == 200) {

                        console.log("Response from server:", xhr.responseText);

                        // Parse the JSON only if the response is not empty

                    } else {

                        console.error("Error: " + xhr.status);

                    }

                }

            };



            // Send the JSON data in the request body

            xhr.send(jsonSelectedItems);

        }





    </script>



</body>



</html>

<?php

include('footer.html');

    }

    else{

        header('Location:..\Login-System\login\index.php');

    }

    ?>