<html></head>







</head>

<body>

<?php



define('TITLE', "Login");

include '../assets/layouts/header.php';

check_logged_out();



?>





<div class="container">

    <div class="row">

        <div class="col-sm-4">

        <?php
            if(isset($_SESSION['STATUS']['mailstatus'])){
                echo $_SESSION['STATUS']['mailstatus'];
                unset($_SESSION['STATUS']['mailstatus']);
            }
        ?>

        </div>

        <div class="col-sm-4">



                <?php if (isset($_GET['selector']) && isset($_GET['validator'])) { ?>



                    <form class="form-auth" action="includes\reset.inc.php" method="post">



                        <?php

                            insert_csrf_token();



                            $selector = $_GET['selector'];

                            $validator = $_GET['validator'];

                        ?>



                        <input type="hidden" name="selector" value="<?php echo $selector; ?>">

                        <input type="hidden" name="validator" value="<?php echo $validator; ?>">



                        <div class="text-center">

                            <img class="mb-1" src="../assets/images/hks.png" alt="" width="130" height="130">

                        </div>



                        <h6 class="h5 mb-3 font-weight-normal text-muted text-center">Reset password</h6>



                        <div class="text-center mb-3">

                            <small class="text-success font-weight-bold">

                                <?php

                                    if (isset($_SESSION['STATUS']['resetsubmit']))

                                        echo $_SESSION['STATUS']['resetsubmit'];



                                ?>

                            </small>

                        </div>



                        <div class="text-center mb-3">

                            <sub class="text-danger">

                                <?php

                                    if (isset($_SESSION['ERRORS']['passworderror']))

                                        echo $_SESSION['ERRORS']['passworderror'];

                                ?>

                            </sub>

                        </div>



                        <div class=" form-group">

                            <input type="password" id="newpassword" name="newpassword" class="form-control" placeholder="New Password" autocomplete="new-password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$" 

           title="Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one digit, and one special character">

                        </div>



                        <div class=" form-group mb-5">

                            <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" placeholder="Confirm Password" autocomplete="new-password">

                        </div>



                        <button class="btn btn-lg btn-primary btn-block mb-5 mt-4" type="submit" value="resetsubmit" name="resetsubmit">

                            Reset Password

                        </button>



                        <p class="mt-4 mb-3 text-muted text-center">

                            

                        </p>



                    </form>



                <?php } else { ?>



                    <form class="form-auth" action="includes/sendtoken.inc.php" method="post">



                        <?php insert_csrf_token(); ?>



                        <div class="text-center">

                            <img class="mb-1" src="../assets/images/hks.png" alt="" width="130" height="130">

                        </div>



                        <h6 class="h5 mb-3 font-weight-normal text-muted text-center">Reset password</h6>

                        <?php

                                    if (isset($_SESSION['ERRORS']['sqlerror'])){

                                        echo $_SESSION['ERRORS']['sqlerror'];

                                    }

                                ?>



                        <div class="text-center mb-3">

                            <small class="text-success font-weight-bold">

                                <?php

                                    if (isset($_SESSION['STATUS']['resentsend']))

                                        echo $_SESSION['STATUS']['resentsend'];



                                ?>

                            </small>

                        </div>



                        <div class="form-group">

                            <label for="email" class="sr-only">Email</label>

                            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required autofocus>

                            <sub class="text-danger">

                                <?php

                                    if (isset($_SESSION['ERRORS']['emailerror']))

                                        echo $_SESSION['ERRORS']['emailerror'];

                                ?>

                            </sub>

                        </div>



                        <button class="btn btn-lg btn-primary btn-block mb-5 mt-4" type="submit" id='mil' value="resentsend" name="resentsend">

                            Send Password Reset Link

                        </button>



                        <p class="mt-4 mb-3 text-muted text-center">

                            

                        </p>



                    </form>



                <?php } ?>

               

    </script>

                    

            

        </div>

        <div class="col-sm-4">



        </div>

    </div>

</div>





<?php



include '../assets/layouts/footer.php'



?>

</body>

</html>