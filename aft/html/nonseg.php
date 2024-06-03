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

      <link rel="stylesheet" type="text/css" href="../css/nonseg.css">

</head>

<body>

     

<!-----------------div 2-----------------------!>

<div id="b">

    <table id="tb">

      <tr><th  colspan="2">Filter Options</th></tr>

      <form id="myForm" method="POST" action="nonsegfilter.php">

    <tr><td>From</td><td><input type="date" id="from_date" name="from_date" required>

    <tr><td>To</td><td><input type="date" id="to_date" name="to_date" max="<?php echo date('Y-m-d'); ?>" required>

    

    



<!---------------------------!>

        </select> </td></tr>

<tr id="rowDropdown2">

<td> Local Body Type </td>

<td><select name="lb" id="type">

                                      <option value="all">ALL</option>

                                      <option value="ULB">Urban Local Body</option>

                                      <option value="RLB">Rural Local Body</option></select></td> 

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