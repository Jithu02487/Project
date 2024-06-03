<?php

require_once("../../connection/connection.php");

include("dsession.php");

//////////////////////////////////////////

if (isset($_SESSION['did'])) {

////////////////////////////////////////

include("homeheader.php");

include("footer.php");



///////////////////////////////////////////

?>



<html>

<head>

      <title>district login</title>

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

        <tr><td><a href="nonseg.php"><button type="submit">NON-SEGREGATED > SEGREGATED</button></a></td>

            <td><a href="invoice.php"><button type="submit">INVOICE & CREDIT PENDENCY</button></a></td>

        </tr>

        <tr><td><a href="userfee.php"><button type="submit">USER FEE</button></a></td>

            <td><a href="report.php"><button type="submit">REPORT</button></a></td>

        </tr>

      </table>







        

    </div>

</body>



</html>

<?php

}

else {

    header('Location:../../Login-System/login/sessiondestory.php');

}

?>