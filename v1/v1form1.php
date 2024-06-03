

<?php

include("../connection/connection.php");

include('v1session.php');

if(isset($_SESSION['v1id'])){

include("header.html");

$date= date('y-m-d');



$trid = isset($_GET['id']) ? $_GET['id'] : null;



if ($trid !== null) {

    // echo "hi";

     //echo $trid;

    //echo $v1id;

} else {

    echo "tr_id not set in the URL";

}





// $sql = "select mcf.location,verifier_one.v1_name,hks_request.type,verifier_one.contact as v1contact,verifier_one.lb_id as lbid,secretary.name as secretaryname,secretary.contact as secretarycontact,aft_user.name as aftname,aft_user.contact as aftcontact,hks.account_no,hks.ifsc,hks_user.president,hks_user.president_contact,hks_user.secretary,hks_user.secretary_contact,hks_request.tr_id as trid,localbody.name as lsgi from hks_request join hks on  hks_request.hksid=hks.id  join hks_user on hks.id = hks_user.hksid join mcf on mcf.v1id=hks.v1id join verifier_one on mcf.lb_id=verifier_one.lb_id join secretary on verifier_one.lb_id=secretary.lb_id join localbody on localbody.id=secretary.lb_id join aft_user on localbody.aft_id=aft_user.aft_id where verifier_one.v1id=1 and hks_request.tr_id=$trid";

// // $result = $conn->query($sql);

// // $row = $result->fetch_assoc();

// // session_start();

// // $_SESSION['trid']= $row['trid'];

// // $_SESSION['lbid']= $row['lbid'];



// $result = $conn->query($sql);



// if (!$result) {

//     die("Database query failed: " . $conn->error);

// }

// if ($result->num_rows > 0) {

//     $row = $result->fetch_assoc();

//     // Process the data

// } else {

//     echo "No records found.";

// }

// session_start();



// if ($result->num_rows > 0) {

//     $row = $result->fetch_assoc();

//     $_SESSION['trid'] = $row['trid'];

//     $_SESSION['lbid'] = $row['lbid'];

// } else {

//     echo "No records found.";

// }





// session_start();



$sql = "SELECT mcf.location, verifier_one.v1_name, hks_request.type, verifier_one.contact as v1contact, verifier_one.lb_id as lbid, secretary.name as secretaryname, secretary.contact as secretarycontact, aft_user.name as aftname, aft_user.contact as aftcontact, hks.account_no, hks.ifsc, hks_user.president, hks_user.president_contact, hks_user.secretary, hks_user.secretary_contact, hks_request.tr_id as trid, localbody.name as lsgi 

        FROM hks_request 

        JOIN hks ON hks_request.hksid = hks.id 

        JOIN hks_user ON hks.id = hks_user.hksid 

        JOIN mcf ON mcf.v1id = hks.v1id 

        JOIN verifier_one ON mcf.lb_id = verifier_one.lb_id 

        JOIN secretary ON verifier_one.lb_id = secretary.lb_id 

        JOIN localbody ON localbody.id = secretary.lb_id 

        JOIN aft_user ON localbody.aft_id = aft_user.aft_id 

        WHERE verifier_one.v1id ='$v1id' AND hks_request.tr_id = '$trid'";

//echo$sql;

$result = $conn->query($sql);



if (!$result) {

    die("Database query failed: " . $conn->error);

}



if ($result->num_rows > 0) {

    // Fetch the first row

    $row = $result->fetch_assoc();

    $_SESSION['trid'] = $row['trid'];

    $_SESSION['lbid'] = $row['lbid'];

    // Process the data or perform other actions

} else {

    echo "No records found.";

}



$result->close();



$selectedOption=$row['type'];

// Close the database connection

$conn->close();

?>



<!DOCTYPE html>

<html>

<head>

    <style>

        .bg-color{

            background: "white";

        }

    </style>



    <title>Data Collection Form</title>

    <!-- Include Bootstrap CSS (you might need to download and host it locally or use a CDN) -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css">

</head>

<body class="bg-color">

    <div class="container mt-5">

        <h1>Data Collection Form</h1>

        <form action="v1action1.php" method="POST" >

            <div class="mb-3">

                <label for="lsgi_name" class="form-label">Name of LSGI:</label>

                <input type="text" class="form-control" name="lsgi_name" required value="<?php echo $row['lsgi']; ?>">

            </div>

            <div class="mb-3">

    <label for="date" class="form-label">Date:</label>

    <input type="date" class="form-control" name="v1date" value="<?php echo date('Y-m-d'); ?>" required autocomplete="off">

</div>





            



            <div class="mb-3">

    <label for="waste_type" class="form-label">Type of Waste Collected:</label>

    <select name="waste_type" class="form-select" required onchange="showFields(this.value)">

        <option value="" disabled>Select</option>

        <option value="Segregated" <?php echo ($selectedOption == 'Segregated') ? 'selected' : ''; ?>>Segregated</option>

        <option value="Mixed" <?php echo ($selectedOption == 'Mixed') ? 'selected' : ''; ?>>Mixed</option>

    </select>

</div>



<!-- Fields for Segregated Waste -->

<div class="mb-3" id="segregated_fields" style="display: none;">

    <label for="segregated_item" class="form-label">Specify the Item:</label>

    <input type="text" class="form-control" name="segregated_item">

</div>

<div class="mb-3" id="segregated_quantity_fields" style="display: none;">

    <label for="segregated_quantity" class="form-label">Quantity:</label>

    <input type="text" class="form-control" name="segregated_quantity">

</div>



<!-- Fields for Mixed Waste -->

<!-- <div class="mb-3" id="mixed_fields" style="display: none;">

    <label for="mixed_item" class="form-label">Specify the Item:</label>

    <input type="text" class="form-control" name="mixed_item">

</div> -->

<div class="mb-3" id="mixed_quantity_fields" style="display: none;">

    <label for="mixed_quantity" class="form-label">Quantity:</label>

    <input type="text" class="form-control" name="mixed_quantity">

</div>



<script>

    // Call the showFields function with the initially selected option

    showFields('<?php echo $selectedOption; ?>');



    function showFields(value) {

        const segregatedFields = document.querySelectorAll("#segregated_fields, #segregated_quantity_fields");

        const mixedFields = document.querySelectorAll("#mixed_fields, #mixed_quantity_fields");



        if (value === "Segregated") {

            showElements(segregatedFields);

            hideElements(mixedFields);

        } else if (value === "Mixed") {

            hideElements(segregatedFields);

            showElements(mixedFields);

        } else {

            hideElements(segregatedFields);

            hideElements(mixedFields);

        }

    }



    function showElements(elements) {

        elements.forEach((element) => element.style.display = "block");

    }



    function hideElements(elements) {

        elements.forEach((element) => element.style.display = "none");

    }

</script>



            <div class="mb-3">

                <label for="location" class="form-label">Location:</label>

                <input type="text" class="form-control" name="location" required value="<?php echo $row['location']; ?>">

            </div>



            <div class="mb-3">

                <label for="vehicle_access" class="form-label" required >Vehicle Access:</label>

                <select name="vehicle_access" class="form-select" required>

                    <option value="Heavy hint">-select-</option>

                    <option value="Heavy">Heavy</option>

                    <option value="Medium">Medium</option>

                    <option value="Light">Light</option>

                </select>

            </div>



            <div class="mb-3">

                <label for="assistant_secretary_name" class="form-label">Name of the Verifier Two:</label>

                <input type="text" class="form-control" name="assistant_secretary_name" required value="<?php echo $row['secretaryname']; ?>">

            </div>



            <div class="mb-3">

                <label for="assistant_secretary_contact" class="form-label">Contact Number:</label>

                <input type="text" class="form-control" name="assistant_secretary_contact" value="<?php echo $row['secretarycontact']; ?>">

            </div>

            <div class="mb-3">

                <label for="VEO_name" class="form-label">Name of the Verifier 1:</label>

                <input type="text" class="form-control" name="VEO_name" value="<?php echo $row['v1_name']; ?>">

            </div>



            <div class="mb-3">

                <label for="VEO_contact" class="form-label">Contact Number:</label>

                <input type="text" class="form-control" name="VEO_contact" value="<?php echo $row['v1contact']; ?>">

            </div>

            <div class="mb-3">

                <label for="performance_audit_supervisor" class="form-label">Name of the Area Facilitation Officer:</label>

                <input type="text" class="form-control" name="performance_audit_supervisor" value="<?php echo $row['aftname']; ?>">

            </div>



            <div class="mb-3">

                <label for="audit_supervisor_contact" class="form-label">Contact Number:</label>

                <input type="text" class="form-control" name="audit_supervisor_contact" value="<?php echo $row['aftcontact']; ?>">

            </div>

            <div class="mb-3">

                <h4>Details of Haritha karma sena</h4>

                <label for="consortium_president" class="form-label">Name of the Haritha karma sena consortium president:</label>

                <input type="text" class="form-control" name="consortium_president" value="<?php echo $row['president']; ?>">

            </div>



            <div class="mb-3">

                <label for="consortium-president_contact" class="form-label">Contact Number:</label>

                <input type="text" class="form-control" name="consortium_president_contact" value="<?php echo $row['president_contact']; ?>">

            </div>

            <div class="mb-3">

              <label for="consortium_president" class="form-label">Name of the Haritha karma sena consortium Secretary:</label>

              <input type="text" class="form-control" name="consortium_Secretary" value="<?php echo $row['secretary']; ?>">

          </div>



          <div class="mb-3">

              <label for="consortium-president_contact" class="form-label">Contact Number:</label>

              <input type="text" class="form-control" name="consortium_Secretary_contact" value="<?php echo $row['secretary_contact']; ?>">

          </div>

            <label  class="form-label"><h4>Haritha karma sena consortium  Account details:</h4></label> 

            <!-- Add more fields as needed --> <div class="mb-3">

                <label for="accountno" class="form-label">Account no:</label>

                <input type="text" class="form-control" name="accountno" value="<?php echo $row['account_no']; ?>">

            </div>



            <div class="mb-3">

                <label for="ifsc_code" class="form-label">IFSC Code:</label>

                <input type="text" class="form-control" name="ifsc_Code" value="<?php echo $row['ifsc']; ?>">

            </div>



            <!-- <a href="formsubmision.html"><button type="submit" class="btn btn-primary">Submit</button></a> -->

            <div class=" btn btn-primary">

            <input type="Submit" name="submit"  value="submit" class='btn btn-primary'>

            </div>  </form>

    </div>



    <!-- Include Bootstrap JS (you might need to download and host it locally or use a CDN) -->

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.min.js"></script>



    



</body>

</html>

<?php

include('footer.html');

}

else{

    header('Location:..\Login-System\login\index.php');

}

?>