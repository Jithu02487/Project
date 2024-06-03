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

      <link rel="stylesheet" type="text/css" href="../css/liftingfilter.css">

</head>

<body>

     



     <div id="c">

        <?php

$query = "SELECT sec.id, aft.name AS aft_name, aft.id AS aft_id, lb.name AS localbody_name, lb.id AS localbody_id, a.name AS agency_name, a.id AS agency_id 

FROM secretary sec 

INNER JOIN localbody lb ON sec.lb_id = lb.id 

INNER JOIN aft ON lb.aft_id = aft.id 

INNER JOIN agency_localbody al ON al.lb_id = sec.lb_id 

INNER JOIN agency a ON al.agency_id = a.id 

WHERE sec.id = ?";



$stmt = $conn->prepare($query);

$stmt->bind_param("i", $sid); // Assuming $sid is an integer, adjust the type accordingly

$stmt->execute();

$result = $stmt->get_result();



if (!$result) {

die("Error: " . $conn->error);

}

while($rn=mysqli_fetch_array($result)){

$sec=$rn[0];

$aft_name=$rn[1];

$aft=$rn[2];

$lb_name=$rn[3];

$lb=$rn[4];

$agency_name=$rn[5];

$agency=$rn[6];

}

/*---------------------out put set----------------------*/      



/*--------------------------filter------------------------------------------*/

/*-1-*/    $query = "SELECT al.tid,lb.name,lb.type,hk.hks_name,a.name,al.date_of_request,al.date_of_acceptance,al.number_of_reminders,al.reminder_date FROM lifting_pending al INNER JOIN hks hk on al.hksid=hk.id INNER JOIN mcf m ON hk.v1id=m.v1id INNER JOIN localbody lb ON m.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id INNER JOIN agency a ON al.agency_id=a.id WHERE lb.id=$lb";



               echo"<table>";

                     echo"<tr><td colspan='9'><h4>Lifting Pending Filtered On</h4></td></tr><td colspan='9'><h4>Area Facilitation Team : $aft_name | Agency:$agency_name | Local Body : $lb</h4></td></tr>";

                 $result = $conn->query($query);

                 if ($result->num_rows > 0) {



                     echo"<tr><th>Tid</th><th>Local Body<th>Type</th></th><th>Agency</th><th>Date of Request</th><th>Date of Acceptance</th><th>Reminder Count</th><th>Last Reminder Date</th></tr>";

                     while($rn=mysqli_fetch_array($result))

                         {       

                          echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[4]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td><td>$rn[8]</td></tr>";}      

                         }else{echo "<tr><td>No Data Found</td></tr>";}echo"</table>";

echo"</div>";

     echo"<div id='d'>";

       echo"<button id='print-button'>Print</button><button id='exportButton'>Export to Excel</button>";

     echo"</div>";







/*-----------------------------------------------------*/







?>



<!----------------------------script for print------------!>

<script>

document.getElementById("print-button").addEventListener("click", function () {

  // Get the content div

  var contentDiv = document.getElementById("c");



  // Create a new window for printing

  var printWindow = window.open('', '', 'width=600,height=600');

  

  // Write the content of the div to the new window

  printWindow.document.open();

  printWindow.document.write('<html><head><title>Lifting_Pending</title>');

  printWindow.document.write('<style>table { border-collapse: collapse; width: 100%; }');

  printWindow.document.write('table, th, td { border: 1px solid black; }</style></head><body>');

  printWindow.document.write('<h2>Local Body</h2>');

  printWindow.document.write(c.innerHTML);

  printWindow.document.write('</body></html>');

  printWindow.document.close();



  // Print the new window

  printWindow.print("sample.pdf");

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

        a.download = "Lifting_Pending.xls";

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