<?php
require_once("../../connection/connection.php");

// include("aftsession.php");
session_start();
if (isset($_SESSION['auid'])) {

//////////////////////////////////////////

include("homeheader.php");

include("footer.php");



if (isset($_SESSION['auid'])){

    $_SESSION['auid']=$auid;

///////////////////////////////////////////

?>



<html>

<head>

      <title>aft login</title>

      <link rel="stylesheet" type="text/css" href="../css/dishome.css">

</head>

<body>

     

     <div id="c">

        <table>

        <tr><td><a href="localbodies.php"><button type="submit">LOCAL BODIES</button></a></td>

            <td><a href="acceptancepending.php"><button type="submit">ACCEPTANCE PENDING</button></a></td>

        </tr>

        <tr><td><a href="liftingpending.php"><button type="submit">LIFTING PENDING</button></a></td>

            <td><a href="liftingstatus.php"><button type="submit">LIFTING STATUS</button></a></td>

        </tr>

        <tr><td><a href="nonseg.php"><button type="submit">LSD: NON-SEGREGATED > SEGREGATED</button></a></td>

            <td><a href="invoice.php"><button type="submit">INVOICE & CREDIT PENDENCY</button></a></td>

        </tr>

        <tr><td><a href="userfee.php"><button type="submit">USER FEE</button></a></td>

            <td><a href="report.php"><button type="submit">REPORT</button></a></td>

        </tr>

        <tr><td colspan=2><a href="register\index.php"><button type="submit">ADD USER</button></a></td>

      </table>





      </div>





</body>

<script>

    <?php 

        }

    ?>



</script>



</html>

<?php

}

else {

    // header('Location:../../Login-System/login/sessiondestory.php');
    echo "not set";

}

?>