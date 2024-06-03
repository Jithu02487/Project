<?php
include("../connection/connection.php");
include('v1session.php');
if(isset($_SESSION['v1id'])){
include("header.html");

  
?>
<head>
<meta http-equiv="cache-control" content="no-store, no-cache, must-revalidate">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="expires" content="0">

<script>
    // Disable the back button
    history.pushState(null, null, document.URL);
    window.addEventListener('popstate', function () {
        history.pushState(null, null, document.URL);
    });
</script>

</head>
  <div class="container my-5">
   
    <div class="row mt-5">

    

    <div class="col-md-4 " >
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Request From HKS</h5>
                    <!-- <p class="card-text">Click here to add a new MCF entry.</p> -->
                    <a href="pending.php" class="btn btn-primary">Pending Request</a>
                </div></div>
            </div>
    
  
    
    <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Rejected  Requests</h5>
                    <!-- <p class="card-text">Click here to add a new MCF entry.</p> -->
                    <a href="rejectedrequest.php" class="btn btn-primary">Denied</a>
                </div>
            </div></div>
    
            <div class="col-md-4 ">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Actual lifted Data entry</h5>
                    <!-- <p class="card-text">Click here to add a new MCF entry.</p> -->
                    <a href="lifted_request.php" class="btn btn-primary">Data entry</a>
                </div>
            </div>
   </div>
    

 
  
    </div>

     <div class="row mt-5">
     <div class="col-md-4 ">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Payment Details</h5>
                    <!-- <p class="card-text">Click here to add a new MCF entry.</p> -->
                    <a href="listof_requestsfor_paymentdetails.php" class="btn btn-primary">Data entry</a>
                </div>
            </div>
     </div>

     <div class="col-md-4 ">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">House hold &institution</h5>
                    <!-- <p class="card-text">Click here to add a new MCF entry.</p> -->
                    <a href="house_instituation.php" class="btn btn-primary">Data Entry</a>
                </div>
            </div>
   </div>
   <div class="col-md-4 ">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Monthly user fee</h5>
                    <!-- <p class="card-text">Click here to add a new MCF entry.</p> -->
                    <a href="userfee.php" class="btn btn-primary">fee collection</a>
                </div>
            </div>
   </div>
  
    
   </div>
   <div class="row mt-5">

   
<div class="col-md-4 ">
         <div class="card">
             <div class="card-body">
                 <h5 class="card-title">MCF Details</h5>
                 <!-- <p class="card-text">Click here to add a new MCF entry.</p> -->
                 <a href="mcf_front.php" class="btn btn-primary">Data entry</a>
             </div>
         </div>
 
   
</div>
 
<div class="col-md-4">
   <div class="card">
               <div class="card-body">
           <h5 class="card-title">HKS Details</h5>
           <!-- <p class="card-text">Click here to add a new MCF entry.</p> -->
           <a href="hksviewfront.php" class="btn btn-primary">HKS Data</a>
       </div>
   </div>
</div>
<div class="col-md-4">
   <div class="card">
     <div class="card-body">
           <h5 class="card-title">View of MCF</h5>
           <!-- <p class="card-text">Click here to add a new MCF entry.</p> -->
           <a href="mcfview.php" class="btn btn-primary">Mcf Data</a>
       </div>
   </div>
 </div>



</div>
      
   </div>
    
  </div>
  
</div>
</div>
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
// After successful login


?>