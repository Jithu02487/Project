<?php

require_once("../../connection/connection.php");

include("aftsession.php");

if (isset($_SESSION['auid'])) {

//////////////////////////////////////////

include("commonheader.php");

include("footer.php");



///////////////////////////////////////////

?>

<html>

<head>

      <title>Area Facilitation Team login</title>

      <link rel="stylesheet" type="text/css" href="../css/localbodies.css">

</head>

<body>



<!-----------------div 2-----------------------!>

<div id="b">

    <table id="tb">

      <tr><th  colspan="2">Local Bodies</th></tr>

      <form method="POST" action="localbodyfilter.php">

   

<!--PHP FOR DROP DOWN-----!>

    <tr> <td> Local Body Type </td><td><select name="lb" id="type">

                                      <option value='all'>ALL</option>

                                      <option value="ULB">Urban Local Body</option>

                                      <option value="RLB">Rural Local Body</option></select></td> </tr>

    <tr><td colspan="2" id="tbt"><button type="submit" id="btn">Apply Filter</button></td></tr>

</form>

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