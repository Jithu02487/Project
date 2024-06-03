<?php
include("../connection/connection.php");
include('v1session.php');
if(isset($_SESSION['v1id'])){
include("header.html");?>

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
          <div class="col-md-5 custom-margin">
              <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">ADD MCF</h5>
                      <p class="card-text">Click here to add a new MCF entry.</p>
                      <a href="mcf.php" class="btn btn-primary">ADD MCF</a>
                  </div>
              </div>
          </div>
  
          <div class="col-md-5 custom-margin"">
              <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">EDIT</h5>
                      <p class="card-text">Click here to edit existing MCF entries.</p>
                      <a href="listmcf.php" class="btn btn-primary">EDIT</a>
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
?>  