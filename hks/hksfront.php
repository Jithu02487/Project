<?php

include("../connection/connection.php");

include('hkssession.php');

if(isset($_SESSION['id'])){

include("headerhks.html");

?>

<!DOCTYPE html>

<html lang="en">

<body style="background-color: #f5f9f6;">


  <div class="container my-5">

  <div class="row mt-5">



  <div class="col-md-4 ">

            <div class="card">

                <div class="card-body">

                    <h5 class="card-title">Request generate</h5>

                    <!-- <p class="card-text">Click here to add a new MCF entry.</p> -->

                    <a href="hksrequestgeneration.php" class="btn btn-primary">Request</a>

                </div>

            </div></div>



<div class="col-md-4 ">

<div class="card">

    <div class="card-body">

        <h5 class="card-title">Generated Request</h5>

        <!-- <p class="card-text">Click here to add a new MCF entry.</p> -->

        <a href="generatedrequest.php" class="btn btn-primary">View</a>

    </div>

</div>

</div>

<div class="col-md-4 ">

<div class="card">

    <div class="card-body">

        <h5 class="card-title">Actual Lift Entry</h5>

        <!-- <p class="card-text">Click here to add a new MCF entry.</p> -->

        <a href="hks_list_of_request.php" class="btn btn-primary">Data entry</a>

    </div>

</div>



</div></div></div>





  <div class="content container my-5">

    <!-- Content goes here -->

  </div>

  <script>

    const footer = document.querySelector('.footer');

    window.addEventListener('scroll', () => {

      const scrollPosition = window.scrollY;

      footer.style.transform = `translateY(${scrollPosition}px)`;

    });

  </script>

  

 </body>

  </html>

  <?php

  include('footer.html');

}

else{

    header('Location:..\Login-System\login\index.php');

}



  ?>