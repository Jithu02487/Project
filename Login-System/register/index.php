<html>

    <body>





<?php



define('TITLE', "Add User");
session_start();
if(!isset($_SESSION['admin'])){
    include '../assets/layouts/header.php';
}else{
    include '../assets/layouts/header1.php';
}



check_logged_out();



?>





<div class="container">

    <div class="row">

        <div class="col-md-4">



        </div>

        <div class="col-lg-4">



            <form class="form-auth" action="includes/register.inc.php" method="post" enctype="multipart/form-data">



                <?php insert_csrf_token(); ?>



                <div class="picCard text-center">

                    <div class="avatar-upload">

                        <div class="avatar-preview text-center">

                            <div id="imagePreview" style="background-image: url( ../assets/uploads/users/_defaultUser.png );"></div>

                        </div>

                        <div class="avatar-edit">

                            <!-- <input name='avatar' id="avatar" class="fas fa-pencil" type='file' value="Add pic" /> -->

                            <label for="avatar"></label>

                            

                        </div>

                    </div>

                </div>

                <div class="text-center">

                    <sub class="text-danger">

                        <?php

                            if (isset($_SESSION['ERRORS']['imageerror']))

                                echo $_SESSION['ERRORS']['imageerror'];



                                

                            if (isset($_SESSION['ERRORS']['scripterror']))

                                echo $_SESSION['ERRORS']['scripterror'];



                                if (isset($_SESSION['STATUS']['mailstatus']))

                                echo $_SESSION['STATUS']['mailstatus'];

                                



                        ?>

                    </sub>

                </div>

                <hr>

                <h6 class="h3 mt-3 mb-3 font-weight-normal text-muted text-center">Add User</h6>



                <div class="text-center mb-3">

                    <small class="text-success font-weight-bold">

                        <?php

                            if (isset($_SESSION['STATUS']['loginstatus']))

                                echo $_SESSION['STATUS']['loginstatus'];



                        ?>

                    </small>

                </div>



                <div class="form-group">

                    <label for="email" class="sr-only">Email address</label>

                    <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>

                    <sub class="text-danger">

                        <?php

                            if (isset($_SESSION['ERRORS']['emailerror']))

                                echo $_SESSION['ERRORS']['emailerror'];



                        ?>

                    </sub>

                </div>



                <div class="form-group">

                    <label for="password" class="sr-only">First Name</label>

                    <input type="password" id="password" name="password" class="form-control" placeholder="password" pattern="^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{8,}$" 
                    title="Password must be at least 8 characters long and include both letters and digits." required>

                </div>

                <div class="form-group">

                    <label for="first_name" class="sr-only">First Name</label>

                    <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" required>

                </div>



                <div class="form-group">

                    <label for="last_name" class="sr-only">Last Name</label>

                    <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" required>

                </div>



                <div class="form-group">
                    <select id="designation" name="designation" class="form-control" required autofocus>
                    <option value="">Designation</option>
                    <?php
                        $designations = [
                            'VILLAGE EXTENSION OFFICER',
                            'CLERK',
                            'SENIOR CLERK',
                            'HEAD ACCOUNTANT',
                            'HEAD CLERK',
                            'JUNIOR SUPERINTENDENT',
                            'ASSISTANT SECRETARY',
                            'JUNIOR HEALTH INSPECTOR',
                            'HEALTH INSPECTOR',
                            'GENERAL EXTENSION OFFICER',
                            'EXTENSION OFFICER (HOUSING)',
                            'EXTENSION OFFICER (P&M)',
                            'EXTENSION OFFICER (WW)',
                            'JOINT BLOCK DEVELOPMENT OFFICER',
                            'SECRETARY GRAMA PANCHAYATH',
                            'SECRETARY BLOCK PANCHAYATH',
                            'HKS',
                            'SECRETARY MUNICIPALITY',
                            'MALINYA MUKTHAM NAVAKERALAM CAMPAIGN',
                            'HEALTH SUPERVISOR',
                            'CLEAN CITY MANAGER',
                    ];
                    
                    foreach ($designations as $value => $label): ?>
                        
                        <option value="<?php echo $label; ?>"><?php echo $label; ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>




                <div class="form-group">

                    <label for="contact" class="sr-only">Contact Number</label>

                    <input type="text" id="contact" name="contact" class="form-control" placeholder="Contact Number" required autofocus>

                    

                </div>



                <div class="form-group mt-4">

                    <label for="type" class="sr-only">User Type</label>

                    <select class="form-control" id="type" name="type" onchange="showHideSelect()" >

                        <option >User Type</option>

                        <option value="district">District</option>

                        <option value="aft">AFT</option>

                        <option value="secretary">Secretary</option>

                        <option value="v2">V2</option>

                        <option value="v1">V1</option>

                        <option value="hks">hks</option>

                        

                    </select>

                </div>



                <!-- Aft drop down -->

                <div id="aft" class="form-group mt-4">

                    <label for="aft">Select an AFT:</label>

                    <select id="aft" name="aft" class="form-control" required>

                        <option>Select an Option</option>

                    <?php



                        // Establish a database connection

                        require '../assets/setup/db.inc.php';



                        // Fetch data from the database

                        $query = "SELECT id,name FROM aft";

                        $result = mysqli_query($conn, $query);



                        // Check for query execution errors

                        if (!$result) {

                            die("Query failed: " . mysqli_error($connection));

                        }



                        // Output options for select element

                        while ($row = mysqli_fetch_assoc($result)) {

                            echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['name']) . '</option>';

                        }

                    ?>

                    </select>

                </div>



                <!-- Hks drop -->



                <div id="hks" class="form-group mt-4">

                    <label for="hks">Select an MCF:</label>

                    <select id="hks" name="hks" class="form-control" required>

                    <option>Select an Option</option>

                    <?php



                        // Establish a database connection

                        require '../assets/setup/db.inc.php';



                        // Fetch data from the database

                        $query = "SELECT id,location FROM mcf";

                        $result = mysqli_query($conn, $query);



                        // Check for query execution errors

                        if (!$result) {

                            die("Query failed: " . mysqli_error($connection));

                        }



                        // Output options for select element

                        while ($row = mysqli_fetch_assoc($result)) {

                            echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['location']) . '</option>';

                        }

                        

                    ?>

                    </select>



                    

                </div>

<!-- Secretary drop down -->

                <div id="lb" class="form-group mt-4">

                    <label for="lb">Select a localbody:</label>

                    <select id="lb" name="lb" class="form-control" required>

                    <option>Select an Option</option>

                    <?php



                        // Establish a database connection

                        require '../assets/setup/db.inc.php';



                        // Fetch data from the database

                        $query = "SELECT id,name FROM localbody";

                        $result = mysqli_query($conn, $query);



                        // Check for query execution errors

                        if (!$result) {

                            die("Query failed: " . mysqli_error($connection));

                        }



                        // Output options for select element

                        while ($row = mysqli_fetch_assoc($result)) {

                            echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['name']) . '</option>';

                        }

                    ?>

                    </select>

                </div>

                <div class="form-group" id="hks1">

                    <label for="contact" class="sr-only">Secretary Name</label>

                    <input type="text" id="secname" name="secname" class="form-control" placeholder="Secretary Name" >

                    

                </div>

                <div class="form-group" id="hks2">

                    <label for="contact" class="sr-only">Secretary Number</label>

                    <input type="text" id="seccontact" name="seccontact" class="form-control" placeholder="Secretary Contact Number">

                    

                </div>



                <!-- <hr>

                <span class="h5 mb-3 font-weight-normal text-muted text-center">Optional</span>

                <br><br> -->



                <div class="form-group">

                    <label>Gender</label>



                    <div class="custom-control custom-radio custom-control">

                        <input type="radio" id="male" name="gender" class="custom-control-input" value="m">

                        <label class="custom-control-label" for="male">Male</label>

                    </div>

                    <div class="custom-control custom-radio custom-control">

                        <input type="radio" id="female" name="gender" class="custom-control-input" value="f">

                        <label class="custom-control-label" for="female">Female</label>

                    </div>

                </div>



                <button class="btn btn-lg btn-primary btn-block" type="submit" name='signupsubmit'>Signup</button>



                <p class="mt-4 mb-3 text-muted text-center">

                    

                </p>



            </form>



        </div>

        <div class="col-md-4">



        </div>

    </div>

</div>







<?php



include '../assets/layouts/footer.php'



?>



<script type="text/javascript">

        document.addEventListener("DOMContentLoaded", function() {

            // Hide the second select element on page load

            document.getElementById("aft").style.display = "none";

            document.getElementById("lb").style.display = "none";

            document.getElementById("hks").style.display = "none";

            document.getElementById("hks1").style.display = "none";

            document.getElementById("hks2").style.display = "none";

        });



        function showHideSelect() {

            var typeSelect = document.getElementById("type");

            var aftDiv = document.getElementById("aft");

            var lbDiv = document.getElementById("lb");

            var hksDiv = document.getElementById("hks");

            var hkssec = document.getElementById("hks1");

            var hkssecph = document.getElementById("hks2");

            lbDiv.style.display = "none";

            aftDiv.style.display = "none";

            hkssec.style.display = "none";

            hkssecph.style.display = "none";

            if (typeSelect.value === "aft") {

                aftDiv.style.display = "block";

            }else {

                aftDiv.style.display = "none";

            }



            if (typeSelect.value === "hks") {

                hksDiv.style.display = "block";

                hkssec.style.display = "block";

            hkssecph.style.display = "block";

            }else {

                hksDiv.style.display = "none";

                hkssec.style.display = "none";

                hkssecph.style.display = "none";

            }



            if(typeSelect.value === "secretary"){

                lbDiv.style.display = "block";

            } else if(typeSelect.value === "v2"){

                lbDiv.style.display = "block";

            }else if(typeSelect.value === "v1"){

                lbDiv.style.display = "block";

            }else if(typeSelect.value === "hks"){

                lbDiv.style.display = "block";

            }else{

                lbDiv.style.display = "none";

            }

        }

</script>



    </body></html>