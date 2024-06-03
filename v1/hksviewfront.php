<?php
include("../connection/connection.php");
include('v1session.php');
if(isset($_SESSION['v1id'])){
include("header.html");
?>

  <!-- <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>MCF Management</title> -->
      <!-- Bootstrap CSS link -->
      <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  </head> -->
  <!-- <body class="container mt-5"> -->
      <div class="row mt-5">
      <div class="col-md-4  custom-margin">
              <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">ADD HKS</h5>
                      <p class="card-text">Click here to add a new HKS entry.</p>
                      <a href="addhks.php" class="btn btn-primary">ADD HKS</a>
                  </div>
              </div>
          </div>
          
          <div class="col-md-4  custom-margin">
              <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">ADD HKS Consortium</h5>
                      <p class="card-text">Click here to add  HKS Consortium details.</p>
                      <a href="register\includes\register.inc.php" class="btn btn-primary">ADD Details</a>
                  </div>
              </div>
          </div>
          <div class="col-md-4  custom-margin">
              <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">View HKS</h5>
                      <p class="card-text">Click here to View HKS entries.</p>
                      <a href="v1hks.php" class="btn btn-primary">View</a>
                  </div>
              </div>
          </div>
      </div>
  
      <!-- Bootstrap JS and Popper.js
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
  <!-- </body> -->
  </html>
  
<div class="content container my-10">
    <!-- Content goes here -->
  </div>
  <script>
    const footer = document.querySelector('.footer');
    window.addEventListener('scroll', () => {
      const scrollPosition = window.scrollY;
      footer.style.transform = `translateY(${scrollPosition}px)`;
    });
  </script>
  

  <?php
include('footer.html');
}
else{
    header('Location:..\Login-System\login\index.php');
}
?>  ?>