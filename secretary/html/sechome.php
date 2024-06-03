<?php

require_once("../../connection/connection.php");

include("ssession.php");

if (isset($_SESSION['sid'])) {

//////////////////////////////////////////

include("homeheader.php");

include("footer.php");





///////////////////////////////////////////

?>



<html>

<head>

      <title>Secretary login</title>

      <link rel="stylesheet" type="text/css" href="../css/dishome.css">

</head>

<body>

    

     <div id="c">

        <table>

        <tr>

            <td><a href="acceptancefilter.php"><button type="submit">ACCEPTANCE PENDING</button></a></td>

            <td><a href="liftingfilter.php"><button type="submit">LIFTING PENDING</button></a></td>

        </tr>

        <tr>

            <td><a href="liftingstatus.php"><button type="submit">LIFTING STATUS</button></a></td>

            <td><a href="userfee.php"><button type="submit">USER FEE</button></a></td>

        </tr>

        <tr>

        <td><a href="register\index.php"><button type="submit">ADD USER</button></a></td>

        <td><a href="chooseagency.php"><button type="submit">CHOOSE AGENCY</button></a></td>

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