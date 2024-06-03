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

      <link rel="stylesheet" type="text/css" href="../css/reportfilter.css">

</head>

<body>



     <div id="b">

       <a href="report.php"><button type="submit">Filter<img src="..\images\filter.png"></button></a>

     </div>

     <div id="c">

<table>

        <?php

             if ($_SERVER["REQUEST_METHOD"] == "POST") {

                 $from=$_POST["from_date"];

                 $to=$_POST["to_date"];



/*--------------------------filter------------------------------------------*/

/*--------Lifting Status----------*/





$query = "

SELECT v.tid, v.verified, v.hks_request_date, v.verified_date, al.tid, aft.name AS aft_name, lb.name AS localbody_name, lb.type AS localbody_type, hk.hks_name, a.name AS agency_name, al.date_of_request, al.date_of_acceptance, al.date_of_lifting, al.quantity, al.seg_weight, al.non_seg_weight, al.invoice_id, al.invoice_date, al.amount, al.payment, al.date_of_payment, al.utr 

FROM lifting_invoice_status al 

INNER JOIN verification v ON al.tid = v.tid 

INNER JOIN hks hk ON al.hks_id = hk.id 

INNER JOIN mcf m ON hk.v1id=m.v1id 

INNER JOIN localbody lb ON m.lb_id = lb.id 

INNER JOIN aft ON lb.aft_id = aft.id 

INNER JOIN agency a ON al.agency_id = a.id 

WHERE v.hks_request_date >= ? AND v.hks_request_date <= ?";

$stmt = $conn->prepare($query);

$stmt->bind_param("ss", $from, $to);

$stmt->execute();

$result = $stmt->get_result();



if (!$result) {

    die("Error: " . $conn->error);

}

if ($result->num_rows > 0) {

echo"<tr><td colspan='21'><h4>Lifting Status</h4></td></tr>";

echo"<tr><th>Tid</th><th>HKS Request Date</th><th>V1&V2 verified</th><th>Date of Approval</th><th>Area Facelitation Team</th><th>Local Body<th>Type</th></th><th>Agency</th><th>Date of Request</th><th>Date of Acceptance</th><th>Date of Lifting</th><th>Quantity Lifted</th><th>Waste Type</th><th>Weight</th><th>Invoice ID</th><th>Invoice Date</th><th>Amount</th><th>Payment Date</th><th>UTR</th></tr>";



while($rn=mysqli_fetch_array($result))

                         {

                          if($rn[14] !=0 || $rn[15] !=0){    

                          if($rn[14]!=0){$waste='Segregated';$w=$rn[14];} else if($rn[15]!=0){$waste='Non-Segregated';$w=$rn[15];}

                          echo"<tr><td>$rn[0]</td><td>$rn[2]</td><td>$rn[1]</td><td>$rn[3]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td><td>$rn[9]</td><td>$rn[10]</td><td>$rn[11]</td><td>$rn[12]</td><td>$rn[13]</td><td>$waste</td><td>$w</td><td>$rn[16]</td><td>$rn[17]</td><td>$rn[18]</td><td>$rn[20]</td><td>$rn[21]</td></tr>";}



                          else{echo"<tr><td>$rn[0]</td><td>$rn[2]</td><td>$rn[1]</td><td>$rn[3]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td><td>$rn[9]</td><td>$rn[10]</td><td>$rn[11]</td><td>$rn[12]</td><td>$rn[13]</td><td colspan = '7'>Invoice Pending</tr>";} }    

                         }









/*----------------------------------------------------------------Lifting Pending----*/





$query = "

SELECT v.tid, v.verified, v.hks_request_date, v.verified_date, al.tid, aft.name AS aft_name, lb.name AS localbody_name, lb.type AS localbody_type, hk.hks_name, a.name AS agency_name, al.date_of_request, al.date_of_acceptance, al.number_of_reminders

FROM lifting_pending al

INNER JOIN verification v ON al.tid = v.tid

INNER JOIN hks hk ON al.hksid = hk.id

INNER JOIN mcf m ON hk.v1id=m.v1id

INNER JOIN localbody lb ON m.lb_id = lb.id

INNER JOIN aft ON lb.aft_id = aft.id

INNER JOIN agency a ON al.agency_id = a.id

WHERE v.hks_request_date >= ? AND v.hks_request_date <= ?";



$stmt = $conn->prepare($query);

$stmt->bind_param("ss", $from, $to);

$stmt->execute();

$result = $stmt->get_result();



if (!$result) {

    die("Error: " . $conn->error);

}

if ($result->num_rows > 0) {

echo"<tr><td colspan='21'><h4>Lifting Pending From Agency</h4></td></tr>";

  echo"<tr><th>Tid</th><th>HKS Request Date</th><th>V1&V2 verified</th><th>Date of Approval</th><th>Area Facelitation Team</th><th>Local Body<th>Type</th></th><th>Agency</th><th>Date of Request</th><th>Date of Acceptance</th></tr>";

while($rn=mysqli_fetch_array($result))

                         {       

                          echo"<tr><td>$rn[0]</td><td>$rn[2]</td><td>$rn[1]</td><td>$rn[3]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td><td>$rn[9]</td><td>$rn[10]</td><td>$rn[11]</td></tr>";}      

                         }







/*-------------------------Acceptance pending----------*/



$query = "

SELECT v.tid, v.verified, v.hks_request_date, v.verified_date, aft.name AS aft_name, lb.name AS localbody_name, lb.type AS localbody_type, hk.hks_name, a.name AS agency_name, al.date_of_request, al.number_of_reminders, al.reminder_date

FROM acceptance_pending al

INNER JOIN verification v ON al.tid = v.tid

INNER JOIN hks hk ON al.hksid = hk.id

INNER JOIN mcf m ON hk.v1id=m.v1id

INNER JOIN localbody lb ON m.lb_id = lb.id

INNER JOIN aft ON lb.aft_id = aft.id

INNER JOIN agency a ON al.agency_id = a.id

WHERE v.hks_request_date >= ? AND v.hks_request_date <= ?";



$stmt = $conn->prepare($query);

$stmt->bind_param("ss", $from, $to);

$stmt->execute();

$result = $stmt->get_result();



if (!$result) {

    die("Error: " . $conn->error);

}

if ($result->num_rows > 0) {

echo"<tr><td colspan='21'><h4>Acceptance Pending</h4></td></tr>";

    echo"<tr><th>Tid</th><th>HKS Request Date</th><th>V1&V2 verified</th><th>Date of Approval</th><th>Area Facelitation Team</th><th>Local Body<th>Type</th></th><th>Agency</th><th>Date of Request</th></tr>";

while($rn=mysqli_fetch_array($result))

                         {       

                           echo"<tr><td>$rn[0]</td><td>$rn[2]</td><td>$rn[1]</td><td>$rn[3]</td><td>$rn[4]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[8]</td><td>$rn[9]</td></tr>";}}





/*-------------------------Approval pending----------*/

$query = "

SELECT v.tr_id, v.trackid, v.date, aft.name AS aft_name, lb.name AS localbody_name, lb.type AS localbody_type

FROM hks_request v

INNER JOIN mcf on v.mcfid=mcf.id

INNER JOIN localbody lb ON mcf.lb_id = lb.id

INNER JOIN aft ON lb.aft_id = aft.id

WHERE v.date >= ? AND v.date <= ? AND v.trackid !='2'";





$stmt = $conn->prepare($query);

$stmt->bind_param("ss", $from, $to);

$stmt->execute();

$result = $stmt->get_result();



if (!$result) {

    die("Error: " . $conn->error);

}

if ($result->num_rows > 0) {

echo"<tr><td colspan='21'><h4>Approval Pending From Verifier</h4></td></tr>";



    echo"<tr><th>Tid</th><th>HKS Request Date</th><th>V1&V2 verified</th><th>Area Facelitation Team</th><th>Local Body<th>Type</th></th></tr>";

while($rn=mysqli_fetch_array($result))

                         {       

                           echo"<tr><td>$rn[0]</td><td>$rn[2]</td><td>no</td><td>$rn[3]</td><td>$rn[4]</td><td>$rn[5]</td></tr>";}}





}?>

</table>

</div>

<div id="d">

<button id="print-button">Print</button><button id="exportButton">Export to Excel</button>

</div>

<!----------------------------script for print------------!>

<script>

document.getElementById("print-button").addEventListener("click", function () {

  // Get the content div

  var contentDiv = document.getElementById("c");



  // Create a new window for printing

  var printWindow = window.open('', '', 'width=600,height=600');

  

  // Write the content of the div to the new window

  printWindow.document.open();

  printWindow.document.write('<html><head><title>Report</title>');

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

        a.download = "Report.xls";

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