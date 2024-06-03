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

                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="localbodies.php"

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

                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../reports/final.php"

                                aria-expanded="false">

                                <i class="fas fa-clipboard-list" aria-hidden="true"></i>

                                <span class="hide-menu">Generate Reports</span>

                            </a>

                        </li>

                        <li class="sidebar-item">

                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../reset.php"

                                aria-expanded="false">

                                <i class="fas fa-solid fa-key" aria-hidden="true"></i>

                                <span class="hide-menu">Password reset</span>

                            </a>

                        </li>

                        <li class="sidebar-item">

                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../../district/html/dishome.php"

                                aria-expanded="false">

                                <i class="fas fa-solid fa-eye" aria-hidden="true"></i>

                                <span class="hide-menu">District View</span>

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

                        <h4 class="page-title">Manage Local Bodies</h4>

                    </div>

                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                        <div class="d-md-flex">

                            <ol class="breadcrumb ms-auto">

                                <li class="fw-normal">Admin Dashboard</li>

                            </ol>

                            <a href='add_lb.php' class="btn btn-success d-md-block pull-right ms-sm-1 ms-lg-3 text-white">

                                Add Local Body

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

                <div class="row justify-content-center">

                    <div class="col-lg-4 col-md-12 mycard">

                        <div class="white-box analytics-info">

                            <h3 class="box-title">Urban Local Bodies</h3>

                            <ul class="list-inline two-part d-flex align-items-center mb-0">

                                <li>

                                    <i class="fa fa-university fa-3x text-info" aria-hidden="true"></i>

                                </li>

                                <li class="ms-auto"><span class="counter text-info">

                                    <?php

                                        $sql = "SELECT count('type') as lb_count FROM localbody WHERE type='ULB'";

                                        $result = $conn->query($sql);

                                        $row=$result->fetch_assoc();

                                        echo $row["lb_count"];

                                    ?> 

                                </span></li>

                            </ul>

                        </div>

                    </div>

                    <div class="col-lg-4 col-md-12 mycard">

                        <div class="white-box analytics-info">

                            <h3 class="box-title">Rural Local Bodies</h3>

                            <ul class="list-inline two-part d-flex align-items-center mb-0">

                                <li>

                                    <i class="fa fa-university fa-3x text-purple" aria-hidden="true"></i>

                                </li>

                                <li class="ms-auto"><span class="counter text-purple">

                                    <?php

                                        $sql = "SELECT count('type') as lb_count FROM localbody WHERE type='RLB'";

                                        $result = $conn->query($sql);

                                        $row=$result->fetch_assoc();

                                        echo $row["lb_count"];

                                    ?> 

                                </span></li>

                            </ul>

                        </div>

                    </div>

                    <div class="col-lg-4 col-md-12 mycard">

                        <div class="white-box analytics-info">

                            <h3 class="box-title">Area Facilitation Team</h3>

                            <ul class="list-inline two-part d-flex align-items-center mb-0">

                                <li>

                                    <i class="fa fa-university fa-3x text-secondary" aria-hidden="true"></i>

                                </li>

                                <li class="ms-auto"><span class="counter text-secondary">

                                    <?php

                                        $sql = "SELECT count(DISTINCT aft_id) as lb_count FROM localbody";

                                        $result = $conn->query($sql);

                                        $row=$result->fetch_assoc();

                                        echo $row["lb_count"];

                                    ?> 

                                </span></li>

                            </ul>

                        </div>

                    </div>

              

                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                    <div class="form-group">

                        <div class="row">

                            <div class="col">

                                <select name="selectlb" id="selectOption" class="form-control">

                                    <option hidden>--- Select Local Body ---</option>

                                    <option value="all">All</option>

                                    <option value="ULB">Urban Local Body</option>

                                    <option value="RLB">Rural Local Body</option>

                                </select>

                            </div>

                            <div class="col">

                                <select name="selectaft" id="selectOption" class="form-control">

                                <option hidden>--- Select Area Facilitation Team ---</option>

                                    <option value="all">All</option>

                                    <?php

                                        $sql = "SELECT * FROM aft";

                                        $result = $conn->query($sql);

                                        while ($row = $result->fetch_assoc()) {

                                            echo "<option value='".$row["id"]."'>" . $row["name"] . "</option>";

                                        } 

                                    ?>

                                </select>

                            </div>

                            <div class="col">

                                <button type="submit" class="btn btn-primary form-control">APPLY FILTER</button>

                            </div>

                        </div>

                    </div>

                </form>

                <br>

                <div class="row">

                    <div class="col-sm-12">

                        <?php

                            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                                if (isset($_POST["selectlb"],$_POST["selectaft"])) {

                                    $selectedlb = $_POST["selectlb"];

                                    $selectedaft = $_POST["selectaft"];



                                    // Build the SQL query based on the selected filter

                                    if ($selectedlb === "all" && $selectedaft === "all") {

                                        $query = "SELECT * FROM localbody";

                                    } 

                                    elseif ($selectedlb === "all" && $selectedaft != "all") {

                                        $query = "SELECT * FROM localbody WHERE aft_id = '$selectedaft'";

                                    } 

                                    elseif ($selectedlb != "all" && $selectedaft === "all") {

                                        $query = "SELECT * FROM localbody WHERE type = '$selectedlb'";

                                    } 

                                    else {

                                        $query = "SELECT * FROM localbody WHERE type = '$selectedlb' AND aft_id = '$selectedaft'";

                                    }

                                    $result = $conn->query($query);



                                    echo '<div class="white-box">';

                                    echo '<div class="table-responsive">';

                                    echo '<table class="table text-nowrap">';

                                    echo '<thead>';

                                    echo '<tr>';

                                    echo '<th class="border-top-0">#</th>';

                                    echo '<th class="border-top-0">Name</th>';

                                    echo '<th class="border-top-0">Type</th>';

                                    echo '<th class="border-top-0">AFT</th>';

                                    echo '<th class="border-top-0 text-center">Action</th>';

                                    echo '</tr>';

                                    echo '</thead>';

                                    echo '<tbody>';



                                    if ($result->num_rows > 0) {

                                        $index = 1; // Initialize the index

                                        while ($row = $result->fetch_assoc()) {

                                            

                                            echo "<tr>";

                                            echo "<td>" . $index . "</td>";

                                            echo "<td>" . $row["name"] . "</td>";

                                            echo "<td>" . convertType($row["type"]) . "</td>";



                                            // Fetch the corresponding name from the "aft" table

                                            $aftId = $row["aft_id"];

                                            $aftQuery = "SELECT name FROM aft WHERE id = $aftId";

                                            $aftResult = $conn->query($aftQuery);

                                            

                                            if ($aftResult->num_rows == 1) {

                                                $aftRow = $aftResult->fetch_assoc();

                                                echo "<td>" . $aftRow["name"] . "</td>";

                                            } else {

                                                echo "<td>Nil</td>";

                                            }



                                            echo "<td>

                                            <a href='edit_lb.php?id=" . $row["id"] . "'>

                                                <button type='button' class='btn btn-warning col-lg-6 col-sm-6 col-md-6 col-xs-12'>Edit</button>

                                            </a>

                                            <a href='#'>

                                                <button type='button' class='btn btn-danger col-lg-6 col-sm-6 col-md-6 col-xs-12 text-white' id='deleteBtn' onclick='confirmDelete(" . $row["id"] . ")'>Delete</button>

                                            </a>

                                            </td>";

                                            echo "</tr>";

                                            $index++; // Increment the index for the next row      

                                        }

                                    } else {

                                        echo "No localbodies found.";

                                    }

                                    $conn->close(); 



                                    echo '</tbody>';

                                    echo '</table>'; 

                                    echo '</div>';    

                                    echo '</div>';         

                                }

                            }

                        ?>                               

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