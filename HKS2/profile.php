<?php
include("../connection/connection.php");
include('hkssession.php');
if(isset($_SESSION['id'])){
include("headerhks.html");
?>
<style>
    /* Style for the profile section */
.profile {
    padding: 40px 0;
    background-color: #f8f9fa;
}

/* Style for the profile box */
.box {
    background-color: #fff;
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
}

/* Style for the profile heading */
.profile h2 {
    font-size: 24px;
    color: #333;
}

/* Style for profile information paragraphs */
.profile p {
    margin-bottom: 10px;
    font-size: 16px;
    color: #555;
}

/* Style for the "Edit Profile" button */
.profile .btn-primary {
    font-size: 16px;
    padding: 10px 20px;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    color: #fff;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.profile .btn-primary:hover {
    background-color: #0056b3;
}

    </style>

<body>
<section id="profile" class="profile">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="box">
                        <div class="profile mt-5">
                            <?php
                            // Fetch user profile data from the database
                            $sql = "SELECT * FROM hks_user JOIN hks ON hks_user.hksid=hks.id WHERE hks.id=$hksid";
                            $result = mysqli_query($conn, $sql);

                            // Check if query executed successfully
                            if ($result === false) {
                                die("Query failed: " . mysqli_error($conn));
                            }

                            // Check if there are any rows returned
                            if (mysqli_num_rows($result) > 0) {
                                // Fetch and display user profile information
                                $row = mysqli_fetch_assoc($result);
                                echo "<h2 class='text-center mb-4'>Your Profile</h2>";
                                echo "<p><strong>President:</strong> " . $row["president"] . "</p>";
                                echo "<p><strong>Phone:</strong> " . $row["president_contact"] . "</p>";
                                echo "<p><strong>Secretary:</strong> " . $row["secretary"] . "</p>";
                                echo "<p><strong>Phone:</strong> " . $row["secretary_contact"] . "</p>";
                                echo "<p><strong>HKS:</strong> " . $row["hks_name"] . "</p>";
                                echo "<p><strong>Email:</strong> " . $row["president_email"] . "</p>";
                            } else {
                                echo "<p>No data found in the profile table.</p>";
                            }
                            ?>
                            <div class="text-center mt-4">
                                <a href="#" class="btn btn-primary" onclick="showAlert()">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<script>
    // JavaScript function to show the alert box
    function showAlert() {
        // Display the alert box with the specified message
        alert("Editing profile is not available at this time. Please try again later.");
    }
</script>
</body>
<?php
// include('footer.html');
}
else{
    header('Location:..\Login-System\login\index.php');
}
?>