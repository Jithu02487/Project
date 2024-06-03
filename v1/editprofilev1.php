<?php

session_start();

$v1id=$_SESSION['v1id'];

if(isset($_SESSION['v1id'])){

include('header.html');



// Replace these with your database connection details

$servername = "localhost";

$username = "dbUser";

$password = "dbPassword";

$dbname = "forward_linkage";



// Create a connection to the database

$conn = new mysqli($servername, $username, $password, $dbname);



// Check the connection

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}



// Handle form submission

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve and validate the data submitted via the form

    $newName = $_POST["new_name"];

    $newposition = $_POST["new_position"];

    $newdepartment = $_POST["new_department"];

    $newEmail = $_POST["new_email"];

    $newPhone = $_POST["new_phone"];





    // Update the database with the edited data

    $updateSql = "UPDATE v1profile SET v1name = ?, position = ?, department = ?, email = ?, phone = ? WHERE id = 1";



$stmt = $conn->prepare($updateSql);

$stmt->bind_param("sssss", $newName, $newposition, $newdepartment, $newEmail, $newPhone);



if ($stmt->execute())  {

        $successMessage = "Profile updated successfully.";

    } else {

        $errorMessage = "Error updating profile: " . $conn->error;

    }

}



// SQL query to fetch user's existing profile data

$sql = "SELECT * FROM verifier_one 

        JOIN users ON users.email = verifier_one.v1_email 

        WHERE v1id = ?";



$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $v1id); // Assuming $v1id is an integer, adjust the type accordingly

$stmt->execute();

$result = $stmt->get_result();



if (!$result) {

    die("Error: " . $conn->error);

}

$row = $result->fetch_assoc();



// Close the database connection

$conn->close();

?>



<!DOCTYPE html>

<html>

<head>

    <title>Edit Profile</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>

    <div class="container mt-5">

        <h1>Edit Profile</h1>

        <?php if (isset($successMessage)) { ?>

            <div class="alert alert-success"><?php echo $successMessage; ?></div>

        <?php } ?>

        <?php if (isset($errorMessage)) { ?>

            <div class="alert alert-danger"><?php echo $errorMessage; ?></div>

        <?php } ?>

        <form method="POST" action="editprofilev1.php">

            <div class="form-group">

                <label for="new_name">First Name:</label>

                <input type="text" class="form-control" id="new_name" name="new_name" value="<?php echo $row['first_name']; ?>">

            </div>

            <div class="form-group">

                <label for="last_name">Last Name</label>

                <input type="text" class="form-control" id="new_department" name="last_name" value="<?php echo $row['last_name']; ?>">

            </div>

            <div class="form-group">

                <label for="new_position">Position:</label>

                <input type="text" class="form-control" id="new_position" name="new_position" value="<?php echo $row['designation']; ?>">

            </div>

            

            <div class="form-group">

                <label for="new_email">Email:</label>

                <input type="email" class="form-control" id="new_email" name="new_email" value="<?php echo $row['email']; ?>">

            </div>

            <div class="form-group">

                <label for="new_phone">Phone:</label>

                <input type="text" class="form-control" id="new_phone" name="new_phone" value="<?php echo $row['contact']; ?>">

            </div>

            <button type="submit" class="btn btn-primary">Send Request</button>

        </form>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>



<?php

include('footer.html');

}

else{

    header('Location:..\Login-System\login\index.php');

}

?>?>

