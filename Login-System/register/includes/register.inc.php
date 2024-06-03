<?php



session_start();



require '../../assets/includes/auth_functions.php';

require '../../assets/includes/datacheck.php';

require '../../assets/includes/security_functions.php';



//check_logged_out();





if (isset($_POST['signupsubmit'])) {



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



        $_SESSION['STATUS']['signupstatus'] = 'Request could not be validated';

        header("Location: ../");

        exit();

    }







    require '../../assets/setup/db.inc.php';

    

    //filter POST data

    function input_filter($data) {

        $data= trim($data);

        $data= stripslashes($data);

        $data= htmlspecialchars($data);

        return $data;

    }



    /*

    * -------------------------------------------------------------------------------

    *   Password Generation

    * -------------------------------------------------------------------------------

    */

    function generateStrongPassword($length = 12) {

        // Define characters that can be used in the password

        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $lowercase = 'abcdefghijklmnopqrstuvwxyz';

        $numbers = '0123456789';

        $specialChars = '!@#$%^&*()-_';

    

        // Combine all character sets

        $allChars = $uppercase . $lowercase . $numbers . $specialChars;

    

        // Get the total number of characters

        $charLength = strlen($allChars);

    

        // Ensure the length is at least 8 characters

        $length = max($length, 8);

    

        // Initialize the password variable

        $password = '';

    

        // Ensure at least one character from each set is included

        $password .= $uppercase[rand(0, strlen($uppercase) - 1)];

        $password .= $lowercase[rand(0, strlen($lowercase) - 1)];

        $password .= $numbers[rand(0, strlen($numbers) - 1)];

        $password .= $specialChars[rand(0, strlen($specialChars) - 1)];

    

        // Generate the remaining characters randomly

        for ($i = strlen($password); $i < $length; $i++) {

            $password .= $allChars[rand(0, $charLength - 1)];

        }

    

        // Shuffle the password characters to make it more random

        $password = str_shuffle($password);

    

        return $password;

    }

    

    // Generate a strong password

    // $password = generateStrongPassword();

    

    $email = input_filter($_POST['email']);

    $user_type = input_filter($_POST['type']);

    $username = input_filter($_POST['first_name']);

    $full_name = input_filter($_POST['first_name']);

    $last_name = input_filter($_POST['last_name']);

    $aft=input_filter($_POST['aft']);

    $local_body=input_filter($_POST['lb']);

    $hks=input_filter($_POST['hks']);

    $designation=input_filter($_POST['designation']);

    $number=input_filter($_POST['contact']);

    $seccontact=input_filter($_POST['seccontact']);

    $secname = input_filter($_POST['secname']);

    $pass = input_filter($_POST['password']);



    if (isset($_POST['gender'])) 

        $gender = input_filter($_POST['gender']);

    else

        $gender = NULL;





    /*

    * -------------------------------------------------------------------------------

    *   Data Validation

    * -------------------------------------------------------------------------------

    */



    if (empty($email)) {



        $_SESSION['ERRORS']['formerror'] = 'required fields cannot be empty, try again';

        header("Location: ../");

        exit();

    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {



        $_SESSION['ERRORS']['emailerror'] = 'invalid email';

        header("Location: ../");

        exit();

    } else {



        

        if (!availableEmail($conn, $email)){

            $s=availableEmail($conn, $email);



            $_SESSION['ERRORS']['emailerror'] = "Email already taken";

            header("Location: ../");

            exit();

        }



        /*

        * -------------------------------------------------------------------------------

        *   User Creation

        * -------------------------------------------------------------------------------

        */



        $sql1 = "insert into users( email, password, first_name, last_name, gender, 

                user_type, created_at,verified,designation) 

                values ( ?,?,?,?,?,?, NOW(),?,?)";

        $verified='no';

        $stmt1 = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt1, $sql1)) {



            $_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';

            header("Location: ../");

            exit();

        } 

        else {



            

            $password = generateStrongPassword();

            $hashedPwd = password_hash($pass, PASSWORD_DEFAULT);



            mysqli_stmt_bind_param($stmt1, "ssssssss", $email, $hashedPwd, $full_name, $last_name, $gender, $user_type,$verified,$designation);

            mysqli_stmt_execute($stmt1);

            // if (mysqli_stmt_affected_rows($stmt1) > 0) {

            //     // The statement was successful, and at least one row was affected

            //     $_SESSION['STATUS']['loginstatus'] = 'Account Created';

            //     header("Location: ../");

            //     exit();

            // }else {

            //     // An error occurred or no rows were affected

            //     $_SESSION['ERRORS']['scripterror'] = 'Error: ' . mysqli_error($conn);

            //     header("Location: ../"); // Redirect to an error page or handle the error appropriately

            //     exit();

            // }

        }





            if($user_type =="district"){

                $sql1 = "insert into district(name, email,phn) 

                values ( ?,?,?)";

                $stmt1 = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt1, $sql1)) {



                    $_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';

                    header("Location: ../");

                    exit();

                } 

                else {

                    mysqli_stmt_bind_param($stmt1, "sss", $full_name, $email,$number);

                    mysqli_stmt_execute($stmt1);

                }

                

            }else if($user_type =="hks"){

                $sql1 = "insert into hks_user(president,president_contact,secretary,secretary_contact,hksid,president_email) 

                values ( ?,?,?,?,?,?)";

                $stmt1 = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt1, $sql1)) {



                    $_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';

                    header("Location: ../");

                    exit();

                } 

                else {

                    mysqli_stmt_bind_param($stmt1, "ssssss", $full_name,$number,$secname,$seccontact, $hks,$email);

                    mysqli_stmt_execute($stmt1);

                }

                

            }else if($user_type =="aft"){

                $sql1 = "insert into aft_user(name, email,aft_id,contact) 

                values ( ?,?,?,?)";

                $stmt1 = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt1, $sql1)) {



                    $_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';

                    header("Location: ../");

                    exit();

                } 

                else {

                    mysqli_stmt_bind_param($stmt1, "ssss", $full_name, $email,$aft,$number);

                    mysqli_stmt_execute($stmt1);

                

                }

            }else if($user_type =="secretary"){

                $sql1 = "insert into secretary(name, email,lb_id) 

                values ( ?,?,?)";

                $stmt1 = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt1, $sql1)) {



                    $_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';

                    header("Location: ../");

                    exit();

                } 

                else {

                    mysqli_stmt_bind_param($stmt1, "sss", $full_name, $email,$local_body);

                    mysqli_stmt_execute($stmt1);

                

                }

            }else if($user_type =="v2"){

                $sql1 = "insert into verifier_two(v2_name, v2_email,lb_id) 

                values ( ?,?,?)";

                $stmt1 = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt1, $sql1)) {



                    $_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';

                    header("Location: ../");

                    exit();

                } 

                else {

                    mysqli_stmt_bind_param($stmt1, "sss", $full_name, $email,$local_body);

                    mysqli_stmt_execute($stmt1);

                

                }

            }else if($user_type =="v1"){

                $sql1 = "insert into verifier_one(v1_name, v1_email,lb_id,contact) 

                values ( ?,?,?,?)";

                $stmt1 = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt1, $sql1)) {



                    $_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';

                    header("Location: ../");

                    exit();

                } 

                else {

                    mysqli_stmt_bind_param($stmt1, "ssss", $full_name, $email,$local_body,$number);

                    mysqli_stmt_execute($stmt1);

                

                }

            }else{

                    $_SESSION['STATUS']['loginstatus'] = 'Account Creation failed, please retry';

                    header("Location: ../");

                    exit();

                }

            



            /*

            * -------------------------------------------------------------------------------

            *   Sending Verification Email for Account Activation

            * -------------------------------------------------------------------------------

            */


            // $_SESSION['mail']=$email;

            // $_SESSION['name']=$username;

            // $_SESSION['password']=$password;

            // header("Location: send.inc.php");

            // exit();


            $_SESSION['STATUS']['loginstatus'] = 'Account Created, Please Login';

            header("Location: ../");

            exit();

    }



} 

else {



    header("Location: ../");

    exit();

}

