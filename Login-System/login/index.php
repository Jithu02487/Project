<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>



    <style>

            @import url('https://fonts.googleapis.com/css?family=Raleway:400,700');



*,*:before,*:after{box-sizing:border-box}



body{

  min-height:100vh;

  font-family: 'Raleway', sans-serif;

}



.container{

    position:relative;

  width:100%;

  height:90%;

  overflow:hidden;

  

  &:hover,&:active{

    .top, .bottom{

      &:before, &:after{

        margin-left: 200px;

        transform-origin: -200px 50%;

        transition-delay:0s;

      }

    }

    

    .center{

      opacity:1;

      transition-delay:0.2s;

    }

  }

}



.top, .bottom{

  &:before, &:after{

    content:'';

    display:block;

    position:absolute;

    width:200vmax;

    height:200vmax;

    top:50%;left:50%;

    margin-top:-100vmax;

    transform-origin: 0 50%;

    transition:all 0.5s cubic-bezier(0.445, 0.05, 0, 1);

    z-index:10;

    opacity:0.65;

    transition-delay:0.2s;

  }

}



.top{

  &:before{transform:rotate(45deg);background:#6FB1FC;}

  &:after{transform:rotate(135deg);background: #F2F2F2;}

}



.bottom{

  &:before{transform:rotate(-45deg);background: #9EE19F;}

  &:after{transform:rotate(-135deg);background:#FFDAB9;}

}



.center{

  position:absolute;

  width:400px;

  height:400px;

  top:50%;left:50%;

  margin-left:-200px;

  margin-top:-200px;

  display:flex;

  flex-direction: column;

  justify-content: center;

  align-items: center;

  padding:30px;

  opacity:0;

  transition:all 0.5s cubic-bezier(0.445, 0.05, 0, 1);

  transition-delay:0s;

  color:#333;

  

  input{

    width:100%;

    padding:15px;

    margin:5px;

    border-radius:1px;

    border:1px solid #ccc;

    font-family:inherit;

  }

}



.custom-shadow {

    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); /* Adjust the values as needed */

  }

    </style>

</head>



<body>



    <?php

    define('TITLE', "Login");

    include '../assets/layouts/header.php';

    check_logged_out();

    ?>



<div class="container custom-shadow p-3 mb-5 bg-white rounded">

    <div class="top"></div>

    <div class="bottom"></div>

    <div class="center">

    <div >

                <form class="form-auth" action="includes/login.inc.php" method="post">



                    <?php insert_csrf_token(); ?>



                    <div class="text-center">

                        <img class="mb-1" src="../assets/images/hks.png" alt="" width="130" height="130">

                    </div>



                    <h6 class="h3 mb-3 font-weight-normal text-muted text-center">Login to your Account</h6>



                    <div class="text-center mb-3">

                        <small class="text-success font-weight-bold">

                            <?php

                            if (isset($_SESSION['STATUS']['loginstatus'])) //from reset password

                                echo $_SESSION['STATUS']['loginstatus'];

                            ?>

                        </small>

                    </div>



                    <div class="form-group">

                        <label for="username" class="sr-only">Username</label>

                        <input type="text" id="username" name="username" class="form-control" placeholder="Enter your e-mail" required autofocus>

                        <sub class="text-danger">

                            <?php

                            if (isset($_SESSION['ERRORS']['nouser']))

                                echo $_SESSION['ERRORS']['nouser'];

                            if (isset($_SESSION['ERRORS']['sqlerror']))

                                echo $_SESSION['ERRORS']['sqlerror'];

                            ?>

                        </sub>

                    </div>



                    <div class="form-group">

                        <label for="password" class="sr-only">Password</label>

                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>

                        <sub class="text-danger">

                            <?php

                            if (isset($_SESSION['ERRORS']['wrongpassword']))

                                echo $_SESSION['ERRORS']['wrongpassword'];

                            ?>

                        </sub>

                    </div>



                    <div class="col-auto my-1 mb-4">



                    </div>



                    <button class="btn btn-lg btn-primary btn-block" type="submit" value="loginsubmit" name="loginsubmit"> Login </button>



                    <p class="mt-3 text-muted text-center"><a href="#">forgot password?</a></p>



                    <p class=" mt-4 mb-3 text-muted text-center">
                    <div class="ml-5 d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                    <p class="lead fw-normal mb-0 me-3">Login with</p>
                  

                        <button type="button" class="btn btn-primary btn-floating mx-1" onclick="redirectToPage()">
                          <i class="fab fa-google"></i>
                        </button>

        
                      </div>
                    </p>



                </form>

            </div>

            <div class="col-sm-4">



            </div>

        </div>

    </div>

        <h2>&nbsp;</h2>

    </div>

</div>

            



    <?php

    include '../assets/layouts/footer.php'

    ?>
<script>
  // Define a JavaScript function for redirection
  function redirectToPage() {
    // Redirect to the desired page
    window.location.href = '../index.php';
  }
</script>
</body>



</html>

