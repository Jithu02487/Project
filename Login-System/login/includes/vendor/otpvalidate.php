<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    
    <!-- Add Tailwind CSS stylesheet link -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <style>
        /* Add your custom styles here */
    </style>
</head>
<body>

<?php
    require '../../../assets/setup/db.inc.php';
    session_start(); 
    $email = $_SESSION["email"];
    if(!isset($_POST['verify'])){
        if(isset($_SESSION['error'])){
            echo "<script>alert('{$_SESSION['error']}');</script>";

            unset($_SESSION['error']);
        }
        if(isset($_SESSION['STATUS']['mailstatus'])){
            echo "<script>alert('{$_SESSION['STATUS']['mailstatus']}');</script>";

            unset($_SESSION['error']);
        }

?>
    <div class="h-screen bg-blue-500 py-20 px-3">
    <div class="container mx-auto">
        <div class="max-w-sm mx-auto md:max-w-lg">
            <div class="w-full">
                <div class="bg-white h-64 py-3 rounded text-center">
                    <h1 class="text-2xl font-bold">OTP Verification</h1>
                    <div class="flex flex-col mt-4">
                        <span>Enter the OTP you received at</span>
                        <?php
                               
                            echo "<span class='font-bold'>" . $_SESSION["email"] . "</span>";
                        ?>
                    </div>

                    <form action="otpvalidate.php" method="post">
                    <div id="otp" class="flex flex-row justify-center text-center px-2 mt-5">
            <input class="m-2 border h-10 w-10 text-center form-control rounded" type="text" id="first" name="first" maxlength="1" required/> 
            <input class="m-2 border h-10 w-10 text-center form-control rounded" type="text" id="second" name="second" maxlength="1" required /> 
            <input class="m-2 border h-10 w-10 text-center form-control rounded" type="text" id="third" name="third" maxlength="1" required/> 
            <input class="m-2 border h-10 w-10 text-center form-control rounded" type="text" id="fourth" name="fourth" maxlength="1" required/>
            <input class="m-2 border h-10 w-10 text-center form-control rounded" type="text" id="fifth" name="fifth" maxlength="1" required/> 
            <input class="m-2 border h-10 w-10 text-center form-control rounded" type="text" id="sixth" name="sixth" maxlength="1" required/>
                      </div>
                        <div class="flex justify-center text-center mt-5">
                            <button type="submit" name="verify" id="verify" class="btn btn-secondary">Verify</button>
                        </div>
                    </form>

                    <!-- Additional code can go here, such as the "Resend OTP" link -->
                </div>
            </div>
        </div>
    </div>
</div>

    <?php
    }else{
        require '../../../assets/setup/db.inc.php';

        
        $sql = "SELECT * FROM otp WHERE email = ? ORDER BY created_at DESC LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        // Process the result if needed
        $row = $result->fetch_assoc();
        if ($row) {
            $dbotp = $row['otp'];
            $exp = $row['expires_at'];
        } else {
            $_SESSION['error']='invalid 1';
                header("Location: otpvalidate.php");
        }


            $e_otp=$_POST['first'].$_POST['second'].$_POST['third'].$_POST['fourth'].$_POST['fifth'].$_POST['sixth'];
            $he_otp = md5($e_otp);
            $expr = strtotime($exp);
            if ($expr < time()){
                $_SESSION['error']='Otp expired..! ';
                header("Location: otpvalidate.php");
            }
            else if($he_otp == $dbotp){


                $query = "select * from users where email='$email'";
                    $result = $conn->query($query);
                if ($result->num_rows > 0){
                    // output data of each row
                    while ($row = $result->fetch_row()) {
                    $varify=$row[7];}
                     //section start
                     if($varify=="no"){
                        session_start();
                        $_SESSION['email']=$email;
                        $_SESSION["submit"]="yes";
                        header("Location: insert.php");
                        exit();
                    }else{
                        session_start();
                        $_SESSION['email']=$email;
                        header("Location: insert1.php");
                        exit();

                    }
                           
                }else{
                    echo "<script>alert('No rows found');</script>";
                    }


            }else{
        
                
                $_SESSION['error']='invalid ';
                header("Location: otpvalidate.php");

            }
            
    }


    ?>
    <!-- Add your JavaScript scripts or link to external scripts here -->
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {

function OTPInput() {
const inputs = document.querySelectorAll('#otp > *[id]');
for (let i = 0; i < inputs.length; i++) { inputs[i].addEventListener('keydown', function(event) { if (event.key==="Backspace" ) { inputs[i].value='' ; if (i !==0) inputs[i - 1].focus(); } else { if (i===inputs.length - 1 && inputs[i].value !=='' ) { return true; } else if (event.keyCode> 47 && event.keyCode < 58) { inputs[i].value=event.key; if (i !==inputs.length - 1) inputs[i + 1].focus(); event.preventDefault(); } else if (event.keyCode> 64 && event.keyCode < 91) { inputs[i].value=String.fromCharCode(event.keyCode); if (i !==inputs.length - 1) inputs[i + 1].focus(); event.preventDefault(); } } }); } } OTPInput(); });
    </script>
</body>
</html>
