<?php
include("../connection/connection.php");
include('hkssession.php');
if(isset($_SESSION['id'])){
include("headerhks.html");

$p=$hksid;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hksname = $_POST['hksname'];
    //$date = $_POST['date'];
    $mcfid =  $_POST['mcf'];
    $weight = $_POST['weight'];
    $type = $_POST['type'];


    // Validate and sanitize user input (implement as needed)

    $query = "SELECT * FROM hks WHERE hks_name='$hksname'";
    $result = $conn->query($query);
$date=date('Y-m-d');
    if ($result->num_rows > 0) {
        while($row = $result->fetch_row()){  // Use fetch_assoc to get an associative array
            $hksid = $row[0];  // Replace with the actual column name
            //$mcfid = $row[3];  // Replace with the actual column name
            }  // Replace with the actual column name

        // Perform additional operations if needed with $hksid and $mcfid

        $query2 = "INSERT INTO hks_request (hks_name, date, type, weight, mcfid,trackid,hksid) VALUES ('$hksname', '$date', '$type', '$weight', '$mcfid','0',$hksid)";
        
        if ($conn->query($query2) === TRUE) {
            echo "<script>alert('Form submitted successfully!');</script>";
          // Successful query execution
        //   header("location:formsubmision.html");
          //exit; // Terminate the script to prevent further output
      } 
    } else {
        echo "No matching record found for hks_name: $hksname";
    }
}


?>
   
<style>
        .minscreen{
            height: 65vh;
        }
        </style>

   <main id="main">     
<body>



<?php
$hksname3 = '';
// include('connection.php');
$query3 = "SELECT * FROM hks WHERE id='$p'";
// $query3 = "SELECT * FROM hks WHERE id=$hksid";
$result3 = $conn->query($query3);

// Check if the query was executed successfully
if (!$result3) {
    die("Query failed: " . $conn->error);
}

// Check if there are rows returned
if ($result3->num_rows > 0) {
    // Loop through the results
    while ($row = $result3->fetch_row()) {
        $hksname3 = $row[1];// Replace with the actual column name
        // Replace with the actual column name
    }
    // echo$hksname3;
} else {
    // Handle case when no rows are returned
    echo "No rows found.";
}

// Close the database connection if needed
//$conn->close();
?>


<div class="container mt-3">
<!-- <div class="row mt-5">  -->
<!-- <div class="container mt-5"> -->
  

    <form name="hksrequest" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" autocomplete="off">
        <div class="mb-2">
            <label for="hksname" class="form-label"><b>LSGI Name</b></label>
            <input type="text" class="form-control" placeholder="LSGI Name" name="hksname"  required value="<?php echo $hksname3; ?>">
        </div>
        <div class="mb-3">
            <label for="mcf" class="form-label"><b>Mcf</b></label>
            <select name="mcf" class="form-select" required >
                <option value="">--Select--</option> <?php
                $h = "SELECT id, location FROM mcf WHERE hksid='$hksid  '";
                $r = $conn->query($h);

                if ($r->num_rows > 0) {
                    while ($row = $r->fetch_assoc()) {
                        echo '<option value="' . $row['id'] . '">' . $row['location'] . '</option>';
                    }
                } else {
                    echo "No MCF records found.";
                }
                ?>
            
            </select>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label"><b>Date of Submission</b></label>
            <input type="date" class="form-control" name="date" value="<?php echo date('Y-m-d');?>" required autocomplete="off">
        </div>

        <div class="mb-3">
            <label for="type" class="form-label"><b>Type</b></label>
            <select name="type" class="form-select" required onchange="showFields(this.value)">
                <option value="">--Select</option>
                <option value="Segregated">Segregated</option>
                <option value="Mixed">Mixed</option>
            </select>
        </div>

        <div class="mb-3">
    <label for="weight" class="form-label"><b>Weight(Kg)</b></label>
    <input type="text" class="form-control" placeholder="Weight(Kg)" name="weight" id="weightInput" required autocomplete="off">
    <small id="weightHelp" class="form-text text-muted">Please enter a value greater than 500.</small>
</div>

<script>
    document.getElementById('weightInput').addEventListener('input', function () {
        var inputValue = parseFloat(this.value);

        // Check if the entered value is greater than or equal to 500
        if (inputValue >= 500) {
            // Valid input
            document.getElementById('weightInput').setCustomValidity('');

            // Submit the form
            document.forms['hksrequestgeneration'].submit();
        } else {
            // Invalid input
            document.getElementById('weightInput').setCustomValidity('Weight must be greater than 500(Kg)');
            document.getElementById('weightHelp').style.display = 'block';
        }
    });
</script>

<div>

        <button type="submit" class="btn btn-primary"><b>Submit</b></button>
    </form>
</div>


        </form>
      </div>
</div>
</body></main>
<?php
// include('footer.html');
}
else{
    header('Location:..\Login-System\login\index.php');
}
?>