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

      <link rel="stylesheet" type="text/css" href="../css/acceptancepending.css">

</head>

<body>

    

<!-----------------div 2-----------------------!>

<div id="b">

    <table id="tb">

      <tr><th  colspan="2">Lifting Request Acceptance Pending</th></tr>

      <form id="myForm" method="POST" action="acceptancefilter.php">

    <tr id="dropdown1Row"> <td> Agency </td><td><select name="agency" id="agency">

                             echo"<option value='all'>ALL</option>";

    <!--PHP FOR DROP DOWN-----!>

    <?php

     $query = "SELECT * FROM agency a 

     INNER JOIN agency_localbody alb ON a.id = alb.agency_id 

     INNER JOIN localbody lb ON alb.lb_id = lb.id 

     INNER JOIN aft_user au ON lb.aft_id = au.aft_id 

     WHERE au.id = ? 

     GROUP BY a.id";



$stmt = $conn->prepare($query);



if ($stmt === false) {

die('Error preparing statement: ' . $conn->error);

}

$stmt->bind_param("i", $auid);

$res = $stmt->execute();



if ($res === false) {

die('Error executing statement: ' . $stmt->error);

}

$result = $stmt->get_result();



if ($result === false) {

die('Error getting result set: ' . $stmt->error);

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