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

      <link rel="stylesheet" type="text/css" href="../css/nonseg.css">

</head>

<body>



<!-----------------div 2-----------------------!>

<div id="b">

    <table id="tb">

      <tr><th  colspan="2">LSGD With Non-Segregated Than Segregated Waste-Filter Options</th></tr>

      <form id="myForm" method="POST" action="nonsegfilter.php">

    <tr><td>From</td><td><input type="date" id="from_date" name="from_date" required>

    <tr><td>To</td><td><input type="date" id="to_date" name="to_date" max="<?php echo date('Y-m-d'); ?>" required>

    

    

    <tr id="dropdown2Row"> <td> Area Facilitation Team </td> 

         <td><select name="aft" id="dropdown1">

          <option value='all'>ALL</option>

<!--PHP FOR DROP DOWN-----!>

<?php

     $query = "SELECT * FROM aft";

     $result = $conn->query($query);

     if (!$result) {

      die("Error: " . $conn->error);

  }

     if ($result->num_rows > 0) {

                             while($rn=mysqli_fetch_array($result))

                             {       

                              echo"<option value='$rn[0]'>$rn[1]</option>";}}?>

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