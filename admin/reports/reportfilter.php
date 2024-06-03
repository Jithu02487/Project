<?php
include('../../connection/connection.php');
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Tells search engine robots what they can and cannot do on a certain page -->
    <meta name="robots" content="noindex,nofollow">
    
    <title> Eco Track Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/lsgd.png">
    <!-- Custom CSS -->
    <link href="../css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/dashboard.css">
    
    <script>
        function confirmDelete(localId) {
            var confirmation = confirm("Are you sure you want to delete localbody with ID " + localId + "?");

            if (confirmation) {
                // User clicked OK, proceed with the deletion
                window.location.href = 'delete_lb.php?id=' + localId;
            } else {
                // User clicked Cancel, do nothing
            }
        }

        // Function to convert type
        <?php
        function convertType($type) {
            switch ($type) {
                case "RLB":
                    return "Rural Local Body";
                case "ULB":
                    return "Urban Local Body";
                // Add more cases for other types if needed
                default:
                    return $type; // Return the original type if no match
            }
        }
        ?>
    </script>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="#">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!-- Dark Logo icon -->
                            <img src="../plugins/images/lsgd.png" alt="homepage" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text 
                            <img src="plugins/images/logo-text.png" alt="homepage" />
                            -->
                            <p style="color:gray; text-align:center; margin: 5px 0;" > ECO TRACK </p>
                        </span>
                    </a>

                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav d-none d-md-block d-lg-none">
                        <li class="nav-item">
                            <a class="nav-toggler nav-link waves-effect waves-light text-white"
                                href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav ms-auto d-flex align-items-center">

                        
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li>
                            <a class="profile-pic" href="../profile.php">
                                <img src="../plugins/images/users/d1.jpg" alt="user-img" width="36"
                                    class="img-circle"><span class="text-white font-medium">Joint Director</span></a>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item pt-2">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../admin_dashboard.php"
                                aria-expanded="false">
                                <i class="far fa-clock" aria-hidden="true"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../profile.php"
                                aria-expanded="false">
                                <i class="far fa-user" aria-hidden="true"></i>
                                <span class="hide-menu">Profile</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../user/manage_users.php"
                                aria-expanded="false">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <span class="hide-menu">Manage Users</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../lb/localbodies.php"
                                aria-expanded="false">
                                <i class="fa fa-university" aria-hidden="true"></i>
                                <span class="hide-menu">Manage Local Bodies</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../waste/manage_waste.php"
                                aria-expanded="false">
                                <i class="fa fa-recycle" aria-hidden="true"></i>
                                <span class="hide-menu">Manage Waste Materials</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../agency/manage_agency.php"
                                aria-expanded="false">
                                <i class="fas fa-dolly-flatbed" aria-hidden="true"></i>
                                <span class="hide-menu">Manage Agencies</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="final.php"
                                aria-expanded="false">
                                <i class="fas fa-clipboard-list" aria-hidden="true"></i>
                                <span class="hide-menu">Generate Reports</span>
                            </a>
                        </li>
                        <li class="text-center p-20 upgrade-btn">
                            <a href="../../Login-System/login/sessiondestory.php" class="btn d-grid btn-danger text-white">
                                Logout
                            </a>
                        </li>
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="min-height: 250px;">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Report</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li class="fw-normal">Admin Dashboard</li>
                            </ol>
                            <a href="final.php" type="submit" class="btn btn-info d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">
                                Filter <img src="../plugins/images/filter.png">
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                
     <div id="c">
<table>
        <?php
             if ($_SERVER["REQUEST_METHOD"] == "POST") {
                 $from=$_POST["from_date"];
                 $to=$_POST["to_date"];

/*--------------------------filter------------------------------------------*/
/*--------Lifting Status----------*/


$query = "
SELECT v.tid, v.verified, v.hks_request_date, v.verified_date, al.tid, aft.name AS aft_name, lb.name AS localbody_name, lb.type AS localbody_type, hk.hks_name, a.name AS agency_name, al.date_of_request, al.date_of_acceptance, al.date_of_lifting, al.quantity, al.seg_weight, al.non_seg_weight, al.invoice_id, al.invoice_date, al.amount, al.payment, al.date_of_payment, al.utr 
FROM lifting_invoice_status al 
INNER JOIN verification v ON al.tid = v.tid 
INNER JOIN hks hk ON al.hks_id = hk.id 
INNER JOIN mcf m ON hk.v1id=m.v1id 
INNER JOIN localbody lb ON m.lb_id = lb.id 
INNER JOIN aft ON lb.aft_id = aft.id 
INNER JOIN agency a ON al.agency_id = a.id 
WHERE v.hks_request_date >= ? AND v.hks_request_date <= ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $from, $to);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Error: " . $conn->error);
}
if ($result->num_rows > 0) {
echo"<tr><td colspan='21'><h4>Lifting Status</h4></td></tr>";
echo"<tr><th>Tid</th><th>HKS Request Date</th><th>V1&V2 verified</th><th>Date of Approval</th><th>Area Facelitation Team</th><th>Local Body<th>Type</th></th><th>Agency</th><th>Date of Request</th><th>Date of Acceptance</th><th>Date of Lifting</th><th>Quantity Lifted</th><th>Waste Type</th><th>Weight</th><th>Invoice ID</th><th>Invoice Date</th><th>Amount</th><th>Payment Date</th><th>UTR</th></tr>";

while($rn=mysqli_fetch_array($result))
                         {
                          if($rn[14] !=0 || $rn[15] !=0){    
                          if($rn[14]!=0){$waste='Segregated';$w=$rn[14];} else if($rn[15]!=0){$waste='Non-Segregated';$w=$rn[15];}
                          echo"<tr><td>$rn[0]</td><td>$rn[2]</td><td>$rn[1]</td><td>$rn[3]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td><td>$rn[9]</td><td>$rn[10]</td><td>$rn[11]</td><td>$rn[12]</td><td>$rn[13]</td><td>$waste</td><td>$w</td><td>$rn[16]</td><td>$rn[17]</td><td>$rn[18]</td><td>$rn[20]</td><td>$rn[21]</td></tr>";}

                          else{echo"<tr><td>$rn[0]</td><td>$rn[2]</td><td>$rn[1]</td><td>$rn[3]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td><td>$rn[9]</td><td>$rn[10]</td><td>$rn[11]</td><td>$rn[12]</td><td>$rn[13]</td><td colspan = '7'>Invoice Pending</tr>";} }    
                         }




/*----------------------------------------------------------------Lifting Pending----*/


$query = "
SELECT v.tid, v.verified, v.hks_request_date, v.verified_date, al.tid, aft.name AS aft_name, lb.name AS localbody_name, lb.type AS localbody_type, hk.hks_name, a.name AS agency_name, al.date_of_request, al.date_of_acceptance, al.number_of_reminders
FROM lifting_pending al
INNER JOIN verification v ON al.tid = v.tid
INNER JOIN hks hk ON al.hksid = hk.id
INNER JOIN mcf m ON hk.v1id=m.v1id
INNER JOIN localbody lb ON m.lb_id = lb.id
INNER JOIN aft ON lb.aft_id = aft.id
INNER JOIN agency a ON al.agency_id = a.id
WHERE v.hks_request_date >= ? AND v.hks_request_date <= ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $from, $to);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Error: " . $conn->error);
}
if ($result->num_rows > 0) {
echo"<tr><td colspan='21'><h4>Lifting Pending From Agency</h4></td></tr>";
  echo"<tr><th>Tid</th><th>HKS Request Date</th><th>V1&V2 verified</th><th>Date of Approval</th><th>Area Facelitation Team</th><th>Local Body<th>Type</th></th><th>Agency</th><th>Date of Request</th><th>Date of Acceptance</th></tr>";
while($rn=mysqli_fetch_array($result))
                         {       
                          echo"<tr><td>$rn[0]</td><td>$rn[2]</td><td>$rn[1]</td><td>$rn[3]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td><td>$rn[9]</td><td>$rn[10]</td><td>$rn[11]</td></tr>";}      
                         }



/*-------------------------Acceptance pending----------*/

$query = "
SELECT v.tid, v.verified, v.hks_request_date, v.verified_date, aft.name AS aft_name, lb.name AS localbody_name, lb.type AS localbody_type, hk.hks_name, a.name AS agency_name, al.date_of_request, al.number_of_reminders, al.reminder_date
FROM acceptance_pending al
INNER JOIN verification v ON al.tid = v.tid
INNER JOIN hks hk ON al.hksid = hk.id
INNER JOIN mcf m ON hk.v1id=m.v1id
INNER JOIN localbody lb ON m.lb_id = lb.id
INNER JOIN aft ON lb.aft_id = aft.id
INNER JOIN agency a ON al.agency_id = a.id
WHERE v.hks_request_date >= ? AND v.hks_request_date <= ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $from, $to);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Error: " . $conn->error);
}
if ($result->num_rows > 0) {
echo"<tr><td colspan='21'><h4>Acceptance Pending</h4></td></tr>";
    echo"<tr><th>Tid</th><th>HKS Request Date</th><th>V1&V2 verified</th><th>Date of Approval</th><th>Area Facelitation Team</th><th>Local Body<th>Type</th></th><th>Agency</th><th>Date of Request</th></tr>";
while($rn=mysqli_fetch_array($result))
                         {       
                           echo"<tr><td>$rn[0]</td><td>$rn[2]</td><td>$rn[1]</td><td>$rn[3]</td><td>$rn[4]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[8]</td><td>$rn[9]</td></tr>";}}


/*-------------------------Approval pending----------*/
$query = "
SELECT v.tr_id, v.trackid, v.date, aft.name AS aft_name, lb.name AS localbody_name, lb.type AS localbody_type
FROM hks_request v
INNER JOIN mcf on v.mcfid=mcf.id
INNER JOIN localbody lb ON mcf.lb_id = lb.id
INNER JOIN aft ON lb.aft_id = aft.id
WHERE v.date >= ? AND v.date <= ? AND v.trackid !='2'";


$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $from, $to);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Error: " . $conn->error);
}
if ($result->num_rows > 0) {
echo"<tr><td colspan='21'><h4>Approval Pending From Verifier</h4></td></tr>";

    echo"<tr><th>Tid</th><th>HKS Request Date</th><th>V1&V2 verified</th><th>Area Facelitation Team</th><th>Local Body<th>Type</th></th></tr>";
while($rn=mysqli_fetch_array($result))
                         {       
                           echo"<tr><td>$rn[0]</td><td>$rn[2]</td><td>no</td><td>$rn[3]</td><td>$rn[4]</td><td>$rn[5]</td></tr>";}}


}?>
</table>
</div>
<div id="d" class="row">
<button id="print-button" class="col btn btn-success">Print</button><button id="exportButton" class="col btn btn-primary">Export to Excel</button>
</div>
<!----------------------------script for print------------!>
<script>
document.getElementById("print-button").addEventListener("click", function () {
  // Get the content div
  var contentDiv = document.getElementById("c");

  // Create a new window for printing
  var printWindow = window.open('', '', 'width=600,height=600');
  
  // Write the content of the div to the new window
  printWindow.document.open();
  printWindow.document.write('<html><head><title>Report</title>');
  printWindow.document.write('<style>table { border-collapse: collapse; width: 100%; }');
  printWindow.document.write('table, th, td { border: 1px solid black; }</style></head><body>');
  printWindow.document.write('<h2>Local Body</h2>');
  printWindow.document.write(c.innerHTML);
  printWindow.document.write('</body></html>');
  printWindow.document.close();

  // Print the new window
  printWindow.print("sample.pdf");
  printWindow.close();

});
//////////////////////////////
document.getElementById("exportButton").addEventListener("click", function () {
        var table = document.getElementById("c");
        var html = table.innerHTML;

        // Create a blob with the HTML content
        var blob = new Blob([html], {
            type: "application/vnd.ms-excel"
        });

        var a = document.createElement("a");
        a.href = URL.createObjectURL(blob);
        a.download = "Report.xls";
        a.click();
    });

</script>

                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center"> 
                2024 © LSGD Government of Kerala | Deveoped by MCA Dept., RIT, Kottayam
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/app-style-switcher.js"></script>
    <script src="../plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>    <script src="../js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../js/custom.js"></script>
</body>

</html>