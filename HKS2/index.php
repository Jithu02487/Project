<?php
include("../connection/connection.php");
include('hkssession.php');
if(isset($_SESSION['id'])){
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Forward Linkage</title>
  <title>Forward Linkage</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Sailor
  * Updated: Mar 13 2024 with Bootstrap v5.3.3
  * Template URL: https://bootstrapmade.com/sailor-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <!-- <img src="assets/img/logo-en-LSGD.png" alt="Admin Logo" class="logo"> -->
      <!-- Uncomment below if you prefer to use an image logo -->
      <a href="index.html" ><img src="assets/img/logo-en-LSGD.png"   class="img-fluid"></a> 

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php" class="active">Home</a></li>
           <li><a href="profile.php">Profile</a></li>
          <!-- <li><a href="portfolio.html">Portfolio</a></li>
          <li><a href="pricing.html">Pricing</a></li>
          <li><a href="blog.html">Blog</a></li> -->
          <li><a href="hksrequestgeneration.php">Request Generation</a></li>
          <li><a href="generatedrequest.php">View Request Status</a></li>
          <li><a href="hks_list_of_request.php">Actual data Entry</a></li>
          <li><a href="logout.php" class="getstarted">Logout</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->




  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <div class="container mt-5">
    
      <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

          <div class="row">

            <div class="col-lg-8 entries">

              <article class="entry">

                <div class="entry-img">
                  <img src="assets/img/hkslogo.png" alt="" class="img-fluid">
                </div>

                <h2 class="entry-title">
                  <a href="">Haritha Karma Sena -Local Self Government Department</a>
                </h2>


              </article><!-- End blog entry -->

            <!-- End blog entry -->

    <!-- End blog entry -->

            

            

          </div><!-- End blog entries list -->

          <div class="col-lg-4">

            <div class="sidebar">

              <!-- <h3 class="sidebar-title">Search</h3> -->
              <!-- <div class="sidebar-item search-form">
                <form action="">
                  <input type="text">
                  <button type="submit"><i class="bi bi-search"></i></button>
                </form>
              </div>End sidebar search formn -->

              <h3 class="sidebar-title">Options</h3>
              <div class="sidebar-item categories">
                <ul>
                <li><a href="hksrequestgeneration.php">Request Generation</a></li>
          <li><a href="generatedrequest.php">View Request Status</a></li>
          <li><a href="hks_list_of_request.php">Actual data Entry</a></li>
                </ul>
              </div><!-- End sidebar categories-->

              

            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Section -->
    </div>
  </main>
  <!-- ======= Footer ======= -->
  
  
</body>

</html>
<?php

// include('footer.html');
}
else{
    header('Location:..\Login-System\login\index.php');
}
?>