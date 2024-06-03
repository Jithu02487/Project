<?php

require_once("../../connection/connection.php");

include("aftsession.php");

if (isset($_SESSION['auid'])) {

$aft=$_SESSION['aft'];

$agency=$_SESSION['agency'];

$lb=$_SESSION['lb'];

//////////////////////////////////////////



include("commonheader.php");

include("footer.php");

///////////////////////////////////////////

?>

<html>

<head>

      <title>Area Facilitation Team login</title>

      <link rel="stylesheet" type="text/css" href="../css/liftingpendingreminder.css">

</head>

<body>

     

     <div id="b">

       <a href="liftingpending.php"><button type="submit">Filter<img src="..\images\filter.png"></button></a>

     </div>

     <div id="c">

        <?php

/*-----------------------------------------*/

$q = "SELECT aft.id, aft.name FROM aft INNER JOIN aft_user au ON au.aft_id = aft.id WHERE au.id=?";

$stmt = $conn->prepare($q);



if (!$stmt) {

    die("Error in preparing statement: " . $conn->error);

}



// Bind the parameter

$stmt->bind_param("s", $auid);



// Execute the query

$stmt->execute();



// Get the result

$res = $stmt->get_result();



if (!$res) {

    die("Error in query: " . $stmt->error);

}

while($rnn=mysqli_fetch_array($res)){$aft=$rnn[0];$aft_name=$rnn[1];}

/*----------------------------------------*/

                 if($agency !="" && $agency !="all"){

                                   $query = "SELECT name FROM agency WHERE id=$agency";

                                   $result = $conn->query($query);

                                   while($rn=mysqli_fetch_array($result))

                                   {  $agency_name=$rn[0];}

                                   

                                                      }

                   else{$agency_name=$agency;} 

/*---------------------out put set----------------------*/      



/*--------------------------filter------------------------------------------*/

/*-1-*/    if($agency == 'all' && $lb =='all') {$query = "SELECT al.tid,lb.name,lb.type,hk.hks_name,a.name,al.date_of_request,al.date_of_acceptance,al.number_of_reminders,al.reminder_date,a.email FROM lifting_pending al INNER JOIN hks hk on al.hksid=hk.id INNER JOIN mcf m ON hk.v1id=m.v1id

 INNER JOIN localbody lb ON m.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id INNER JOIN agency a ON al.agency_id=a.id WHERE aft.id=$aft AND al.reminder_date < CURDATE() - INTERVAL 5 DAY";



               echo"<table>";

                     echo"<tr><td colspan='9'><h4>Lifting Pending Filtered On</h4></td></tr><td colspan='9'><h4>Area Facilitation Team : $aft_name | Agency:$agency_name | Local Body : $lb</h4></td></tr>";

                 $result = $conn->query($query);

                 if ($result->num_rows > 0) {



                     echo"<tr><th>Tid</th><th>Local Body<th>Type</th></th><th>Agency</th><th>Date of Request</th><th>Date of Acceptance</th><th>Reminder Count</th><th>Send Reminder</th></tr>";

                     while($rn=mysqli_fetch_array($result))

                         {    

                          echo"<form action='liftingpendingremind.php' method='post'>";

                          echo"<input type='hidden' name='ttid' value='$rn[0]'>";

                          echo"<input type='hidden' name='lbname' value='$rn[1]'>";

                          echo"<input type='hidden' name='aname' value='$rn[4]'>";

                          echo"<input type='hidden' name='aemail' value='$rn[9]'>";    

                          echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[4]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td><td><button type='submit'>Remind</button></td></tr>";echo"</form>";}      

                         }else{echo "<tr><td>No Data Found</td></tr>";}echo"</table>";

echo"</div>";







}

/*-----------------------------------------------------*/







/*-------------AFT AND LB------------------*/



/*--2--*/

if($agency=='all' && $lb!='all') {$query = "SELECT al.tid,lb.name,lb.type,hk.hks_name,a.name,al.date_of_request,al.date_of_acceptance,al.number_of_reminders,al.reminder_date,a.email FROM lifting_pending al INNER JOIN hks hk on al.hksid=hk.id INNER JOIN mcf m ON hk.v1id=m.v1id INNER JOIN localbody lb ON m.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id INNER JOIN agency a ON al.agency_id=a.id WHERE lb.type='$lb' AND aft.id=$aft AND al.reminder_date < CURDATE() - INTERVAL 5 DAY";

echo"<table>";

                     echo"<tr><td colspan='9'><h4>Lifting Pending Filtered On</h4></td></tr><tr><td colspan='9'><h4>Area Facilitation Team : $aft_name | Agency:$agency_name | Local Body : $lb</h4></td></tr>";

                     $result = $conn->query($query);

                     if ($result->num_rows > 0) {

                      echo"<tr><th>Tid</th><th>Local Body<th>Type</th></th><th>Agency</th><th>Date of Request</th><th>Date of Acceptance</th><th>Reminders Count</th><th>Send Reminder</th></tr>";

                     while($rn=mysqli_fetch_array($result))

                         {    

                          echo"<form action='liftingpendingremind.php' method='post'>";

                          echo"<input type='hidden' name='ttid' value='$rn[0]'>";

                          echo"<input type='hidden' name='lbname' value='$rn[1]'>";

                          echo"<input type='hidden' name='aname' value='$rn[4]'>";

                          echo"<input type='hidden' name='aemail' value='$rn[9]'>";

                          echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[4]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td><td><button type='submit'>Remind</button></td></tr>";

echo"</form>";}      

                         }else{echo "<tr><td>No Data Found</td></tr>";}echo"</table>";

echo"</div>";







}         



/*--3--*/

if($agency !='all' && $lb =='all') {$query = "SELECT al.tid,lb.name,lb.type,hk.hks_name,a.name,al.date_of_request,al.date_of_acceptance,al.number_of_reminders,al.reminder_date,a.email FROM lifting_pending al INNER JOIN hks hk on al.hksid=hk.id INNER JOIN mcf m ON hk.v1id=m.v1id INNER JOIN localbody lb ON m.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id INNER JOIN agency a ON al.agency_id=a.id WHERE aft.id=$aft AND a.id=$agency AND al.reminder_date < CURDATE() - INTERVAL 5 DAY";

echo"<table>";

                     echo"<tr><td colspan='9'><h4>Lifting Pending Filtered On</h4></td></tr><tr><td colspan='9'><h4><h4>Area Facilitation Team : $aft_name | Agency:$agency_name | Local Body : $lb</h4></td></tr>";

                     $result = $conn->query($query);

                     if ($result->num_rows > 0) {

                     echo"<tr><th>Tid</th><th>Local Body<th>Type</th></th><th>Agency</th><th>Date of Request</th><th>Date of Acceptance</th><th>Reminders Count</th><th>Send Reminder</th></tr>";

                     while($rn=mysqli_fetch_array($result))

                         {    

                          echo"<form action='liftingpendingremind.php' method='post'>";

                          echo"<input type='hidden' name='ttid' value='$rn[0]'>";

                          echo"<input type='hidden' name='ttid' value='$rn[0]'>";

                          echo"<input type='hidden' name='lbname' value='$rn[1]'>";

                          echo"<input type='hidden' name='aname' value='$rn[4]'>";

                          echo"<input type='hidden' name='aemail' value='$rn[9]'>";

                          echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[4]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td><td><button type='submit'>Remind</button></td></tr>";

echo"</form>";}      

                         }else{echo "<tr><td>No Data Found</td></tr>";}echo"</table>";

echo"</div>";





}         

 

/*--4--*/

if($agency !='all' && $lb !='all') {$query = "SELECT al.tid,lb.name,lb.type,hk.hks_name,a.name,al.date_of_request,al.date_of_acceptance,al.number_of_reminders,al.reminder_date,a.email FROM lifting_pending al INNER JOIN hks hk on al.hksid=hk.id INNER JOIN mcf m ON hk.v1id=m.v1id INNER JOIN localbody lb ON m.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id INNER JOIN agency a ON al.agency_id=a.id WHERE aft.id=$aft AND lb.type='$lb' AND al.reminder_date < CURDATE() - INTERVAL 5 DAY";

echo"<table>";

                     echo"<tr><td colspan='9'><h4>Lifting Pending Filtered On</h4></td></tr><tr><td colspan='9'><h4><h4>Area Facilitation Team : $aft_name | Agency:$agency_name | Local Body : $lb</h4></td></tr>";

                     $result = $conn->query($query);

                     if ($result->num_rows > 0) {

                    echo"<tr><th>Tid</th><th>Local Body<th>Type</th></th><th>Agency</th><th>Date of Request</th><th>Date of Acceptance</th><th>Reminders Count</th><th>Send Reminder</th></tr>";

                     while($rn=mysqli_fetch_array($result))

                         {    

                          echo"<form action='liftingpendingremind.php' method='post'>";

                          echo"<input type='hidden' name='ttid' value='$rn[0]'>";

                          echo"<input type='hidden' name='ttid' value='$rn[0]'>";

                          echo"<input type='hidden' name='lbname' value='$rn[1]'>";

                          echo"<input type='hidden' name='aname' value='$rn[4]'>";

                          echo"<input type='hidden' name='aemail' value='$rn[9]'>";

                          echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[4]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td><td><button type='submit'>Remind</button></td></tr>";

echo"</form>";}      

                         }else{echo "<tr><td>No Data Found</td></tr>";}echo"</table>";

echo"</div>";







}         



?>





</body>



</html>

<?php

}

else {

    header('Location:../../Login-System/login/sessiondestory.php');

}

?>