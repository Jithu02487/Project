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

      <link rel="stylesheet" type="text/css" href="../css/invoicepending.css">

</head>

<body>

     

<!-----------------div 2-----------------------!>

<div id="b">

    <table id="tb">

      <tr><th  colspan="2">Filter Options</th></tr>

      <form id="myForm" method="POST" action="invoicependingfilter.php">

    <tr> <td> Agency </td><td><select name="agency" id="agency" onchange="toggleDropdown()" >

                              <option value='all'>ALL</option>

    <!--PHP FOR DROP DOWN-----!>

    <?php

     $query = "SELECT * FROM agency a 

     INNER JOIN agency_localbody alb ON a.id=alb.agency_id 

     INNER JOIN localbody lb ON alb.lb_id=lb.id 

     INNER JOIN aft_user au ON lb.aft_id=au.aft_id 

     WHERE au.id=? 

     GROUP BY a.id";



$stmt = $conn->prepare($query);



if (!$stmt) {

die("Error in preparing statement: " . $conn->error);

}



// Bind the parameter

$stmt->bind_param("s", $auid);



// Execute the query

$stmt->execute();



// Get the result

$result = $stmt->get_result();



if (!$result) {

die("Error in query: " . $stmt->error);

}



if ($result->num_rows > 0) {

            

                             while($rn=mysqli_fetch_array($result))

                             {       

                              echo"<option value='$rn[0]'>$rn[1]</option>";}}?>

<!---------------------------!>

        </select> </td> </tr>



    

<tr>

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