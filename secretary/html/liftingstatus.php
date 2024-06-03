<?php

require_once("../../connection/connection.php");

include("ssession.php");

if (isset($_SESSION['sid'])) {

//////////////////////////////////////////

include("commonheader.php");

include("footer.php");





///////////////////////////////////////////

?>

<html>

<head>

      <title>Secretary login</title>

      <link rel="stylesheet" type="text/css" href="../css/liftingstatus.css">

</head>

<body>

     

<!-----------------div 2-----------------------!>

<div id="b">

    <table id="tb">

      <tr><th  colspan="2">Lifting Status-Filter Options</th></tr>

      <form id="myForm" method="POST" action="liftingstatusfilter.php">

    <tr><td>From</td><td><input type="date" id="from_date" name="from_date" required>

    <tr><td>To</td><td><input type="date" id="to_date" name="to_date" max="<?php echo date('Y-m-d'); ?>" required>

</tr>

<tr><td colspan="2" id="tbt"><button type="submit" id="btn">Apply Filter</button></td></tr>

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