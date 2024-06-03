<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Password</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Create New Password</h2>
                                <p class="text-white-50 mb-5">Please enter your new password!</p>

                                <form method="post" action="resetpass.php" onsubmit="return validatePassword()">
                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="newPassword" name="newPassword" class="form-control form-control-lg" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$" required />
                                        <label class="form-label" for="newPassword">New Password</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control form-control-lg" />
                                        <label class="form-label" for="confirmPassword">Confirm Password</label>
                                    </div>
                                        
                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Change Password</button><br>
                                    <div class="form-outline form-white mb-4">
                                        
                                    </div>
                                        <a class="btn btn-outline-light btn-sl px-2" href="admin_dashboard.php" >Cancel</a><br>
                                    <span>Password must contain at least one lowercase letter, one uppercase letter, one number, and be at least 8 characters long.</span>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <?php
            session_start();
            $_SESSION['status']="approved";
        ?>

<script>
        function validatePassword() {
            var newPassword = document.getElementById("newPassword").value;
            var confirmPassword = document.getElementById("confirmPassword").value;

            // Check if passwords match
            if (newPassword !== confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }

            return true;
        }
    </script>
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
