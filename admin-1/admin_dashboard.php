<?php
include('connection.php');
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
    
    <title> Forward Linkage Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/hks.png">
    <!-- Custom CSS -->
    <link href="css/style.min.css" rel="stylesheet">
    <link href="css/dashboard.css" rel="stylesheet">
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                            <img src="plugins/images/hks.jpeg" alt="homepage" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text 
                            <img src="plugins/images/logo-text.png" alt="homepage" />
                            -->
                            <p style="color:gray; text-align:center; margin: 5px 0;" > FORWARD LINKAGE </p>
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
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class=" in">
                            <form role="search" class="app-search d-none d-md-block me-3">
                                <input type="text" placeholder="Search..." class="form-control mt-0">
                                <a href="" class="active">
                                    <i class="fa fa-search"></i>
                                </a>
                            </form>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li>
                            <a class="profile-pic" href="profile.php">
                                <img src="plugins/images/users/d1.jpg" alt="user-img" width="36"
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
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="admin_dashboard.php"
                                aria-expanded="false">
                                <i class="far fa-clock" aria-hidden="true"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="profile.php"
                                aria-expanded="false">
                                <i class="far fa-user" aria-hidden="true"></i>
                                <span class="hide-menu">Profile</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="user/manage_users.php"
                                aria-expanded="false">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <span class="hide-menu">Manage Users</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="lb/localbodies.php"
                                aria-expanded="false">
                                <i class="fa fa-university" aria-hidden="true"></i>
                                <span class="hide-menu">Manage Local Bodies</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="waste/manage_waste.php"
                                aria-expanded="false">
                                <i class="fa fa-recycle" aria-hidden="true"></i>
                                <span class="hide-menu">Manage Waste Materials</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#.php"
                                aria-expanded="false">
                                <i class="fas fa-file-alt" aria-hidden="true"></i>
                                <span class="hide-menu">View Requests</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="agency/manage_agency.php"
                                aria-expanded="false">
                                <i class="fas fa-dolly-flatbed" aria-hidden="true"></i>
                                <span class="hide-menu">Manage Agencies</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#.php"
                                aria-expanded="false">
                                <i class="fas fa-clipboard-list" aria-hidden="true"></i>
                                <span class="hide-menu">Generate Reports</span>
                            </a>
                        </li>
                        <li class="text-center p-20 upgrade-btn">
                            <a href="logout.php" class="btn d-grid btn-danger text-white">
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
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li class="fw-normal">Admin Dashboard</li>
                            </ol>
                            <a href="logout.php" class="btn btn-danger  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">
                                Logout
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
                <!-- ============================================================== -->
                <!-- Three charts -->
                <!-- ============================================================== -->
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-12 mycard">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Users</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <i class="fa fa-users fa-3x text-purple" aria-hidden="true"></i>
                                </li>
                                <li class="ms-auto"><span class="counter text-purple">
                                    <?php
                                        $sql = "SELECT count(*) as user_count FROM users";
                                        $result = $conn->query($sql);
                                        $row=$result->fetch_assoc();
                                        echo $row["user_count"];
                                    ?> 
                                </span></li>
                            </ul>
                            <hr>
                            <a href="user/manage_users.php"> Manage >> </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mycard">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Local Bodies</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <i class="fa fa-university fa-3x text-warning" aria-hidden="true"></i>
                                </li>
                                <li class="ms-auto"><span class="counter text-warning">
                                    <?php
                                        $sql = "SELECT count(*) as lb_count FROM localbody";
                                        $result = $conn->query($sql);
                                        $row=$result->fetch_assoc();
                                        echo $row["lb_count"];
                                    ?> 
                                </span></li>
                            </ul>
                            <hr>
                            <a href="lb/localbodies.php"> Manage >> </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mycard">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Waste Materials</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <i class="fa fa-recycle fa-3x text-success" aria-hidden="true"></i>
                                </li>
                                <li class="ms-auto"><span class="counter text-success">
                                <?php
                                        $sql = "SELECT count(*) as waste_count FROM waste";
                                        $result = $conn->query($sql);
                                        $row=$result->fetch_assoc();
                                        echo $row["waste_count"];
                                    ?> 
                                </span></li>
                            </ul>
                            <hr>
                            <a href="waste/manage_waste.php"> Manage >> </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mycard">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Requests</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <i class="fas fa-file-alt fa-3x text-dark" aria-hidden="true"></i>
                                </li>
                                <li class="ms-auto"><span class="counter text-info">
                                    <?php
                                       /*  $sql = "SELECT count(*) as lb_count FROM localbody";
                                        $result = $conn->query($sql);
                                        $row=$result->fetch_assoc();
                                        echo $row["lb_count"]; */
                                    ?> 
                                </span></li>
                            </ul>
                            <hr>
                            <a href="#"> Manage >> </a>
                        </div>
                    </div>  
                    <div class="col-lg-4 col-md-12 mycard">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Agency</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <i class="fas fa-dolly-flatbed fa-3x text-info" aria-hidden="true"></i>
                                </li>
                                <li class="ms-auto"><span class="counter text-info">
                                    <?php
                                        $sql = "SELECT count(*) as a_count FROM agency";
                                        $result = $conn->query($sql);
                                        $row=$result->fetch_assoc();
                                        echo $row["a_count"];
                                    ?> 
                                </span></li>
                            </ul>
                            <hr>
                            <a href="agency/manage_agency.php"> Manage >> </a>
                        </div>
                    </div>                    
                    <div class="col-lg-4 col-md-12 mycard">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Reports</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <i class="fas fa-clipboard-list fa-3x text-secondary" aria-hidden="true"></i>
                                </li>
                                <li class="ms-auto"><span class="counter text-secondary">
                                    <?php
                                       /*  $sql = "SELECT count(*) as lb_count FROM localbody";
                                        $result = $conn->query($sql);
                                        $row=$result->fetch_assoc();
                                        echo $row["lb_count"]; */
                                    ?> 
                                </span></li>
                            </ul>
                            <hr>
                            <a href="#"> Manage >> </a>
                        </div>
                    </div>                  
                </div>
                
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
                2023 © Forward Linkage
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
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <script src="plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
</body>

</html>