<?php

require_once("../../connection/connection.php");

include("dsession.php");

//////////////////////////////////////////

if (isset($_SESSION['did'])) {

include("commonheader.php");

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

        

        <tr><td><a href="invoicepaid.php"><button type="submit">PAID</button></a></td>

            <td><a href="invoicepending.php"><button type="submit">PENDING</button></a></td>

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