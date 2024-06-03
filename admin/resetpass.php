<!DOCTYPE html>
<html>
<body>
    
    <?php
    include('../connection/connection.php');
    session_start();
    if(!isset($_SESSION['status'])){
    $email = $_POST['email'];
    $_SESSION['mail']=$email;
    $sql = "SELECT first_name FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);

    // Bind the parameter
    $stmt->bind_param("s", $email);

    // Execute the statement
    $stmt->execute();

    // Bind the result variable
    $stmt->bind_result($resultFirstName);

    // Fetch the result
    $stmt->fetch();

    // Close the statement and connection
    $stmt->close();
    $conn->close();
    if($resultFirstName){
    // Display the confirmation message in JavaScript
    ?>
    <script>
        var confirmation = window.confirm('Are you sure you want to reset the Password for <?php echo $resultFirstName; ?> ?');
        if (confirmation) {
            window.location.href = 'resetpass.1.php';
        } else {
            alert('Password reset cancelled.');
            window.location.href = 'reset.php';
        }
    </script>
    <?php
        }else{
            ?>
        <script>
        
            alert('There is no user with this email..!. Please check the email.');
            window.location.href = 'reset.php';
    </script>

            <?php

        }
    }else{
        include('../connection/connection.php');
        if (isset($_POST['newPassword'], $_SESSION['mail'])) {
            $pass = $_POST['newPassword'];
            $mail = $_SESSION['mail'];
        
            $pass = htmlspecialchars(strip_tags($pass));
            $mail = htmlspecialchars(strip_tags($mail));
        
            // Hash the password
            $hashedPwd = password_hash($pass, PASSWORD_DEFAULT);
        
            $sql = "UPDATE users SET password = ? WHERE email = ?";
            $stmt = $conn->prepare($sql);
        
            if ($stmt) {
                $stmt->bind_param("ss", $hashedPwd, $mail);
                $stmt->execute();
        
                if ($stmt->affected_rows > 0) {
                    echo "<script>alert('Password changed, please remember the password..!');</script>";
                    unset($_SESSION['status']);
                    echo "<script>window.location.href = 'admin_dashboard.php';;</script>";
                } else {
                    echo "<script>alert('No records were updated. Possibly the user with the given email does not exist.');</script>";
                }
        
                $stmt->close();
            } else {
                echo "Error preparing the statement: " . $conn->error;
            }
        } else {
            ?>
            <script>
            
                alert('Invalid Data..!');
                window.location.href = 'reset.php';
        </script>
    
                <?php
        }
        unset($_SESSION['status']);

    }
    ?>
</body>
</html>
