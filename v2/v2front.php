<?PHP
include("../connection/connection.php");
include('v2session.php');
//echo $_SESSION['id'];
if(isset($_SESSION['id'])){
include('headerv2.html');




?>
  <div class="container my-5">
  <div class="row mt-5">

  <div class="col-md-4 ">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Request From Verifier I</h5>
                    <!-- <p class="card-text">Click here to add a new MCF entry.</p> -->
                    <a href="listofverifiedrequestfromv1.php" class="btn btn-primary">Pending Request from vI</a>
                </div>
            </div></div>

<div class="col-md-4 ">
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Verified Request</h5>
        <!-- <p class="card-text">Click here to add a new MCF entry.</p> -->
        <a href="verifiedrequest.php" class="btn btn-primary">View</a>
    </div>
</div>
</div>
<div class="col-md-4 ">
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Rejected Request</h5>
        <!-- <p class="card-text">Click here to add a new MCF entry.</p> -->
        <a href="rejected_request_by_v2_view.php" class="btn btn-primary">View</a>
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
  <?php
  include('footer.html');
}
else{
  header('Location:..\Login-System\login\index.php');
}
  ?>