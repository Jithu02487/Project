<?php



session_start();



require '../../assets/includes/auth_functions.php';

require '../../assets/includes/datacheck.php';

require '../../assets/includes/security_functions.php';



check_logged_out();



if (!isset($_POST['loginsubmit'])){

    $_SESSION['STATUS']['loginstatus'] = 'loginsubmit failed';

    header("Location: ../");

    exit();

}

else {



    /*

    * -------------------------------------------------------------------------------

    *   Securing against Header Injection

    * -------------------------------------------------------------------------------

    */



    foreach($_POST as $key => $value){



        $_POST[$key] = _cleaninjections(trim($value));

    }





    /*

    * -------------------------------------------------------------------------------

    *   Verifying CSRF token

    * -------------------------------------------------------------------------------

    */



    if (!verify_csrf_token()){



        $_SESSION['STATUS']['loginstatus'] = 'Request could not be validated';

        header("Location: ../");

        exit();

    }



    

    require '../../assets/setup/db.inc.php';



    $email = $_POST['username'];

    $password = $_POST['password'];



    if (empty($email) || empty($password)) {



        $_SESSION['STATUS']['loginstatus'] = 'fields cannot be empty';

        header("Location: ../");

        exit();

    } 

    else {



        /*

        * -------------------------------------------------------------------------------

        *   Updating last_login_at

        * -------------------------------------------------------------------------------

        */



        $sql = "UPDATE users SET last_login_at=NOW() WHERE email=?;";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {



            $_SESSION['ERRORS']['sqlerror'] = 'SQL ERROR1';

            header("Location: ../");

            exit();

        }

        else {



            mysqli_stmt_bind_param($stmt, "s", $email);

            mysqli_stmt_execute($stmt);

        }







        /*

        * -------------------------------------------------------------------------------

        *   Creating SESSION Variables

        * -------------------------------------------------------------------------------

        */



        $sql = "SELECT * FROM users WHERE email=?;";

        $stmt = mysqli_stmt_init($conn);



        if (!mysqli_stmt_prepare($stmt, $sql)) {



            $_SESSION['ERRORS']['sqlerror'] = 'SQL ERROR2';

            header("Location: ../");

            exit();

        } 

        else {



            mysqli_stmt_bind_param($stmt, "s", $email);

            mysqli_stmt_execute($stmt);



            $result = mysqli_stmt_get_result($stmt);



            if ($row = mysqli_fetch_assoc($result)) {



                $pwdCheck = password_verify($password, $row['password']);



                if ($pwdCheck == false) {



                    $_SESSION['ERRORS']['wrongpassword'] = 'wrong password';

                    header("Location: ../");

                    exit();

                } 

                else if ($pwdCheck == true) {






                    $_SESSION['id'] = $row['id'];

                    $_SESSION['email'] = $row['email'];

                    $_SESSION['first_name'] = $row['first_name'];

                    $_SESSION['last_name'] = $row['last_name'];

                    $_SESSION['gender'] = $row['gender'];;

                    $_SESSION['created_at'] = $row['created_at'];

                    $_SESSION['updated_at'] = $row['updated_at'];

                    $_SESSION['last_login_at'] = $row['last_login_at'];

                    $eml=$row['email'];

// DISTRICT login--------------------------------------------

                    if($row['user_type']=="district"){

                        $query = "select * from district where email='$eml'";

                        $result = $conn->query($query);

                        if ($result->num_rows > 0){

             // output data of each row

                        while ($r = $result->fetch_row()) {

                          $did=$r[0];}}

                  //section start

                  session_start();

                  $_SESSION['did']=$did; 

                        header("Location: ../../../district/html/dishome.php");

                    exit();

                    }

// V1 login--------------------------------------------

                    if($row['user_type']=="v1"){

                        $query = "select * from verifier_one where v1_email='$eml'";

                        $result = $conn->query($query);

                        if ($result->num_rows > 0){

                        // output data of each row

                        while ($row = $result->fetch_row()) {

                        $id=$row[0];}}

                        //section start

                        $_SESSION['v1id']=$id;

                        header("Location: ../../../v1/vfront.php");

                    exit();

                    }

                    if($row['user_type']=="v2"){

                        $query = "select * from verifier_two where v2_email='$eml'";

                        $result = $conn->query($query);

                        if ($result->num_rows > 0){

                        // output data of each row

                        while ($row = $result->fetch_row()) {

                        $id=$row[0];}}

                        //section start

                        $_SESSION['id']=$id;

                        header("Location: ../../../v2/v2front.php");

                    exit();

                    }

// AFT login--------------------------------------------

                    if($row['user_type']=="aft"){

                        $query = "select * from aft_user where email='$eml'";

                        $result = $conn->query($query);

                        if ($result->num_rows > 0){

                        // output data of each row

                        while ($row = $result->fetch_row()) {

                        $auid=$row[0];}}

                        //section start

                        $_SESSION['auid']=$auid;

                        header("Location: ../../../aft/html/afthome.php");

                    exit();

                    }

// SECRETARY login--------------------------------------------

                    if($row['user_type']=="secretary"){

                        $query = "select * from secretary where email='$eml'";

                        $result = $conn->query($query);

                        if ($result->num_rows > 0){

                        // output data of each row

                        while ($row = $result->fetch_row()) {

                            $sid=$row[0];}}

                    //section start

                    session_start();

                    $_SESSION['sid']=$sid;

                        header("Location: ../../../secretary/html/sechome.php");

                    exit();

                    }



    // HKS LOGIN ------------------------------------------

    if($row['user_type']=="hks"){

        $query = "select hksid from hks_user where president_email='$eml'";

        $result = $conn->query($query);

        if ($result->num_rows > 0){

        // output data of each row

        while ($row = $result->fetch_row()) {

            $sid=$row[0];}}

    //section start

    session_start();

    $_SESSION['id']=$sid;

        header("Location: ../../../HKS2/index.php");

    exit();

    }



    // AGENCY LOGIN ------------------------------------------

    if($row['user_type']=="agency"){

        $query = "select * from agency where email='$eml'";

        $result = $conn->query($query);

        if ($result->num_rows > 0){

        // output data of each row

        while ($row = $result->fetch_row()) {

            $id=$row[0];}}

    //section start

    session_start();

    $_SESSION['id']=$id;

        header("Location: ../../../Agency_in/index.php");

    exit();

    }



    // ADMIN LOGIN -------------------------------------

                    if($row['user_type']=="admin"){

                        $_SESSION['a']=1;

                        header("Location: ../../../admin/admin_dashboard.php");

                    exit();

                    }

                    

                    $_SESSION['STATUS']['loginstatus'] = 'user error';

                    header("Location: ../../home/");

                    exit();

                } 

            } 

            else {



                $_SESSION['ERRORS']['nouser'] = 'username does not exist';

                header("Location: ../");

                exit();

            }

        }

    }

}

