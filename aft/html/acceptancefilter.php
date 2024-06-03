<?php

require_once("../../connection/connection.php");

include("aftsession.php");

if (isset($_SESSION['auid'])) {

//////////////////////////////////////////

include("acceptheader.php");

include("footer.php");





///////////////////////////////////////////

?>

<html>

<head>

      <title>Area Facilitation Team login</title>

      <link rel="stylesheet" type="text/css" href="../css/acceptancefilter.css">

</head>

<body>

     <div id="b">

       

       <a href="acceptancepending.php"><button type="submit">Filter<img src="..\images\filter.png"></button></a>

     </div>

     <div id="c">



        <?php

             if ($_SERVER["REQUEST_METHOD"] == "POST") {

                 $agency =$_POST["agency"];

                  $lb = $_POST["lb"];

/*-----------------------------------------*/

$stmt = $conn->prepare("SELECT aft.id, aft.name FROM aft INNER JOIN aft_user au ON au.aft_id = aft.id WHERE au.id = ?");

if ($stmt === false) {

  die('Error preparing statement: ' . $conn->error);

}

$stmt->bind_param("i", $auid);

$stmt->execute();

if ($stmt === false) {

  die('Error preparing statement: ' . $conn->error);

}



$res = $stmt->get_result();

if ($res === false) {

  die('Error getting result set: ' . $stmt->error);

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





     $_SESSION['aft']=$aft;

     $_SESSION['agency']=$agency;

     $_SESSION['lb']=$lb;

/*---------------------out put set----------------------*/      



/*--------------------------filter------------------------------------------*/



/*-1-*/    if($agency == 'all' && $lb == 'all') {$query = "SELECT al.tid,lb.name,lb.type,hk.hks_name,a.name,al.date_of_request,al.number_of_reminders,al.reminder_date FROM acceptance_pending al INNER JOIN hks hk on al.hksid=hk.id INNER JOIN mcf m ON hk.v1id=m.v1id INNER JOIN localbody lb ON m.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id INNER JOIN agency a ON al.agency_id=a.id WHERE aft.id=$aft";

               echo"<table>";

                     echo"<tr><td colspan='8'><h4>Lifting Request Acceptance Pending - Filtered On</h4></td></tr><td colspan='8'><h4>AFT: $aft_name | Agency:$agency_name | Local Body:$lb </h4></td></tr>";

                 $result = $conn->query($query);

                 if ($result->num_rows > 0) {



                     echo"<tr><th>Tid</th><th>Local Body<th>Type</th></th><th>Agency</th><th>Date of Request</th><th>Reminder Count</th><th>Last Reminder Date</th></tr>";

                     while($rn=mysqli_fetch_array($result))

                         {       

                          echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[4]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td></tr>";}      

                         }else{echo "<tr><td>No Data Found</td></tr>";}echo"</table>";

echo"</div>";

     echo"<div id='d'>";

       echo"<button id='print-button'>Print</button><button id='exportButton'>Export to Excel</button>";

     echo"</div>";





}

/*-----------------------------------------------------*/





/*-2-*/    if($agency != 'all' && $lb == 'all') {$query = "SELECT al.tid,lb.name,lb.type,hk.hks_name,a.name,al.date_of_request,al.number_of_reminders,al.reminder_date FROM acceptance_pending al INNER JOIN hks hk on al.hksid=hk.id INNER JOIN mcf m ON hk.v1id=m.v1id INNER JOIN localbody lb ON m.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id INNER JOIN agency a ON al.agency_id=a.id WHERE al.agency_id=$agency AND aft.id=$aft";



             

/*-----------------------fetching result on table--------------------*/

                     echo"<table>";

                     echo"<tr><td colspan='8'><h4>Lifting Request Acceptance Pending - Filtered On</h4></td></tr><td colspan='8'><h4>Araea Facilitation Team : $aft_name | Local Body : $lb | Agency:$agency_name</h4></td></tr>";

                 $result = $conn->query($query);

                 if ($result->num_rows > 0) {



                     echo"<tr><th>Tid</th><th>Local Body<th>Type</th></th><th>Agency</th><th>Date of Request</th><th>Reminder Count</th><th>Last Reminder Date</th></tr>";

                     while($rn=mysqli_fetch_array($result))

                         {       

                          echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[4]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td></tr>";}      

                         }else{echo "<tr><td>No Data Found</td></tr>";}echo"</table>";

                    echo"</div>";

     echo"<div id='d'>";

       echo"<button id='print-button'>Print</button><button id='exportButton'>Export to Excel</button>";

     echo"</div>";





}

/*-------------AFT AND LB------------------*/





/*--3--*/

if($agency=='all' && $lb!='all') {$query = "SELECT al.tid,lb.name,lb.type,hk.hks_name,a.name,al.date_of_request,al.number_of_reminders,al.reminder_date FROM acceptance_pending al INNER JOIN hks hk on al.hksid=hk.id INNER JOIN mcf m ON hk.v1id=m.v1id INNER JOIN localbody lb ON m.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id INNER JOIN agency a ON al.agency_id=a.id WHERE lb.type='$lb' AND aft.id=$aft";

echo"<table>";

                     echo"<tr><td colspan='8'><h4>Lifting Request Acceptance Pending - Filtered On</h4></td></tr><tr><td colspan='8'><h4>Araea Facilitation Team : $aft_name | Local Body : $lb | Agency:$agency_name</h4></td></tr>";

                     $result = $conn->query($query);

                     if ($result->num_rows > 0) {

                     echo"<tr><th>Tid</th><th>Local Body<th>Type</th></th><th>Agency</th><th>Date of Request</th><th>Reminder Count</th><th>Last Reminder Date</th></tr>";

                     while($rn=mysqli_fetch_array($result))

                         {       

                          echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[4]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td></tr>";}      

                         }else{echo "<tr><td>No Data Found</td></tr>";}echo"</table>";

echo"</div>";

     echo"<div id='d'>";

       echo"<button id='print-button'>Print</button><button id='exportButton'>Export to Excel</button>";

     echo"</div>";







}         





 

/*--4--*/

if($agency !='all' && $lb !='all') {$query = "SELECT al.tid,lb.name,lb.type,hk.hks_name,a.name,al.date_of_request,al.number_of_reminders,al.reminder_date FROM acceptance_pending al INNER JOIN hks hk on al.hksid=hk.id INNER JOIN mcf m ON hk.v1id=m.v1id INNER JOIN localbody lb ON m.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id INNER JOIN agency a ON al.agency_id=a.id WHERE aft.id=$aft AND lb.type='$lb' AND al.agency_id=$agency";

echo"<table>";

                     echo"<tr><td colspan='8'><h4>Lifting Request Acceptance Pending - Filtered On</h4></td></tr><tr><td colspan='8'><h4>Araea Facilitation Team : $aft_name | Local Body : $lb | Agency:$agency_name</h4></td></tr>";

                     $result = $conn->query($query);

                     if ($result->num_rows > 0) {

                     echo"<tr><th>Tid</th><th>Local Body<th>Type</th></th><th>Agency</th><th>Date of Request</th><th>Reminder Count</th><th>Last Reminder Date</th></tr>";

                     while($rn=mysqli_fetch_array($result))

                         {       

                          echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[4]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td></tr>";}      

                         }else{echo "<tr><td>No Data Found</td></tr>";}echo"</table>";

echo"</div>";

     echo"<div id='d'>";

       echo"<button id='print-button'>Print</button><button id='exportButton'>Export to Excel</button>";

     echo"</div>";





}         



}?>



<!----------------------------script for print------------!>

<script>

document.getElementById("print-button").addEventListener("click", function () {

  // Get the content div

  var contentDiv = document.getElementById("c");



  // Create a new window for printing

  var printWindow = window.open('', '', 'width=600,height=600');

  

  // Write the content of the div to the new window

  printWindow.document.open();

  printWindow.document.write('<html><head><title>Pending Acceptance</title>');

  printWindow.document.write('<style>table { border-collapse: collapse; width: 100%; }');

  printWindow.document.write('table, th, td { border: 1px solid black; }</style></head><body>');

  printWindow.document.write('<h2>Local Body</h2>');

  printWindow.document.write(c.innerHTML);

  printWindow.document.write('</body></html>');

  printWindow.document.close();



  // Print the new window

  printWindow.print("Pending_Acceptance.pdf");

  printWindow.close();



});

//////////////////////////////

document.getElementById("exportButton").addEventListener("click", function () {

        var table = document.getElementById("c");

        var html = table.innerHTML;



        // Create a blob with the HTML content

        var blob = new Blob([html], {

            type: "application/vnd.ms-excel"

        });



        var a = document.createElement("a");

        a.href = URL.createObjectURL(blob);

        a.download = "Pending_Acceptance.xls";

        a.click();

    });



</script>

</body>



</html>

<?php

}

else {

    header('Location:../../Login-System/login/sessiondestory.php');

}

?>