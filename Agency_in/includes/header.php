<!DOCTYPE html>

<html lang="en">



  <head>



    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    


    <title> Agency</title>



    <!-- Bootstrap core CSS -->

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">





    <!-- Additional CSS Files -->

    <link rel="stylesheet" href="assets/css/fontawesome.css">

    <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">

    <link rel="stylesheet" href="assets/css/owl.css">

    <link rel="stylesheet" href="assets/css/animate.css">

    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>



  </head>


  <?phP

      include('connection.php');

    //   session_start();

      $id=$_SESSION['id'];

      $sql = "SELECT email FROM agency WHERE id = ?";

      $stmt = $conn->prepare($sql);
  
      $stmt->bind_param("s", $id); 
  
      $stmt->execute();
  
      $result = $stmt->get_result();
      
      if(!$result){
        echo "<script>alert('error')</script>";
      }
  
      $row = $result->fetch_assoc();
  
      $mail = $row['email'];
      
      $_SESSION['id']=$id;
      
  ?>


<body>



<div class="sub-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <ul class="info">
                        <li><i class="fa fa-envelope"></i> <?php echo $mail ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

  <!-- ***** Header Area Start ***** -->

  <header class="header-area header-sticky">

    <div class="container">

        <div class="row">

            <div class="col-12">

                <nav class="main-nav">

                    <!-- ***** Logo Start ***** -->

                    <a href="index.html" class="logo">

                        <h1>Agency</h1>

                    </a>

                    <!-- ***** Logo End ***** -->

                    <!-- ***** Menu Start ***** -->

                    <ul class="nav">

                        <li><a href="index.php" id="pendingRequests">Pending Requests</a></li>

                        <li><a href="accepted.php" id="acceptedRequests">Accepted Requests</a></li>

                        <li><a href="completed.php" id="completedRequests">Completed Requests</a></li>

                        <li><a href=" ../Login-System/login/sessiondestory.php" id="logout">Log Out</a></li>

                    </ul>

 

                    <a class='menu-trigger'>

                        <span>Menu</span>

                    </a>

                    <!-- ***** Menu End ***** -->

                </nav>

            </div>

        </div>

    </div>

  </header>

  <!-- Scripts -->

  <!-- Bootstrap core JavaScript -->

  <script src="vendor/jquery/jquery.min.js"></script>

  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  <script src="assets/js/isotope.min.js"></script>

  <script src="assets/js/owl-carousel.js"></script>

  <script src="assets/js/counter.js"></script>

  <script src="assets/js/custom.js"></script>



  <script>

    document.addEventListener('DOMContentLoaded', function () {

        var url = window.location.pathname;

        var filename = url.substring(url.lastIndexOf('/') + 1);



        // Remove the "active" class from all links

        var links = document.querySelectorAll('.nav a');

        links.forEach(function (link) {

            link.classList.remove('active');

        });



        // Set the "active" class based on the current page

        if (filename === 'index.php') {

            document.getElementById('pendingRequests').classList.add('active');

        } else if (filename === 'accepted.php') {

            document.getElementById('acceptedRequests').classList.add('active');

        } else if (filename === 'completed.php') {

            document.getElementById('completedRequests').classList.add('active');

        } else if (filename === 'contact.php') {

            document.getElementById('contactUs').classList.add('active');

        }

    });

</script>


  </body>

</html>