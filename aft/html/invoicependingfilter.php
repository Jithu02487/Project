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

      <link rel="stylesheet" type="text/css" href="../css/invoicependingfilter.css">

</head>

<body>

     

     <div id="b">

       <a href="invoicepending.php"><button type="submit">Filter<img src="..\images\filter.png"></button></a>

     </div>

     <div id="c">

        <?php

             if ($_SERVER["REQUEST_METHOD"] == "POST") {

                 $agency =$_POST["agency"];

                 $lb = $_POST["lb"];

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





/*-----------------------------------------------------*/







/*-------------AFT AND LB------------------*/

/*--1--*/

if($agency=='all' && $lb=='all') {$query = "SELECT al.tid,lb.name,lb.type,a.name,al.seg_weight,al.non_seg_weight,al.amount,al.invoice_id,al.invoice_date FROM lifting_invoice_status al INNER JOIN hks hk on al.hks_id=hk.id INNER JOIN mcf m ON hk.v1id=m.v1id INNER JOIN localbody lb ON m.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id INNER JOIN agency a ON al.agency_id=a.id WHERE al.invoice='yes' AND al.payment='no' AND aft.id=$aft";

echo"<table>";

                     echo"<tr><td colspan='8'><h4>Filtered On Pending Payments</h4></td></tr><tr><td colspan='8'><h4>Area Facilitation Team: $aft_name | Agency: $agency_name | Local Body:$lb</h4></td></tr>";

                     $result = $conn->query($query);

                     if ($result->num_rows > 0) {

                     echo"<tr><th>Tid</th><th>Local Body<th>Type</th><th>Agency</th><th>Type</th><th>Invoice ID</th><th>Invoice Date</th><th>Amount</th></tr>";

                     while($rn=mysqli_fetch_array($result))

                         {       

                          if($rn[4] != 0){      

                          echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[3]</td><td>From</td><td>$rn[7]</td><td>$rn[8]</td><td>$rn[6]</td></tr>";}else{echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[3]</td><td>To</td><td>$rn[7]</td><td>$rn[8]</td><td>$rn[6]</td></tr>";}



}      

                         }else{echo "<tr><td>No Data Found</td></tr>";}echo"</table>";

echo"</div>";

     echo"<div id='d'>";

       echo"<button id='print-button'>Print</button><button id='exportButton'>Export to Excel</button>";

     echo"</div>";



}         

/*--2--*/

if($agency=='all' && $lb!='all') {$query = "SELECT al.tid,lb.name,lb.type,a.name,al.seg_weight,al.non_seg_weight,al.amount,al.invoice_id,al.invoice_date FROM lifting_invoice_status al INNER JOIN hks hk on al.hks_id=hk.id INNER JOIN mcf m ON hk.v1id=m.v1id INNER JOIN localbody lb ON m.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id INNER JOIN agency a ON al.agency_id=a.id WHERE lb.type='$lb' AND al.invoice='yes' AND al.payment='no' AND aft.id=$aft";

echo"<table>";

                     echo"<tr><td colspan='8'><h4>Filtered On Pending Payments</h4></td></tr><tr><td colspan='8'><h4>Area Facilitation Team: $aft_name | Local Body: $lb | Agency: $agency_name</h4></td></tr>";

                     $result = $conn->query($query);

                     if ($result->num_rows > 0) {

                     echo"<tr><th>Tid</th><th>Local Body<th>Type</th><th>Agency</th><th>Type</th><th>Invoice ID</th><th>Invoice Date</th><th>Amount</th></tr>";

                     while($rn=mysqli_fetch_array($result))

                         {       

                          if($rn[4] != 0){      

                          echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[3]</td><td>From</td><td>$rn[7]</td><td>$rn[8]</td><td>$rn[6]</td></tr>";}else{echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[3]</td><td>To</td><td>$rn[7]</td><td>$rn[8]</td><td>$rn[6]</td></tr>";}



}      

                         }else{echo "<tr><td>No Data Found</td></tr>";}echo"</table>";

echo"</div>";

     echo"<div id='d'>";

       echo"<button id='print-button'>Print</button><button id='exportButton'>Export to Excel</button>";

     echo"</div>";



}         



/*--3--*/

if($agency !='all' && $lb =='all') {$query = "SELECT al.tid,lb.name,lb.type,a.name,al.seg_weight,al.non_seg_weight,al.amount,al.invoice_id,al.invoice_date FROM lifting_invoice_status al INNER JOIN hks hk on al.hks_id=hk.id INNER JOIN mcf m ON hk.v1id=m.v1id INNER JOIN localbody lb ON m.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id INNER JOIN agency a ON al.agency_id=a.id WHERE aft.id=$aft AND al.invoice='yes' AND al.payment='no' AND al.agency_id=$agency";

echo"<table>";

                     echo"<tr><td colspan='8'><h4>Filtered On Pending Payments</h4></td></tr><tr><td colspan='8'><h4>Area Facilitation Team: $aft_name | Local Body: $lb | Agency: $agency_name</h4></td></tr>";

                     $result = $conn->query($query);

                     if ($result->num_rows > 0) {

                     echo"<tr><th>Tid</th><th>Local Body<th>Type</th><th>Agency</th><th>Type</th><th>Invoice ID</th><th>Invoice Date</th><th>Amount</th></tr>";

                     while($rn=mysqli_fetch_array($result))

                         {       

                          if($rn[4] != 0){      

                          echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[3]</td><td>From</td><td>$rn[7]</td><td>$rn[8]</td><td>$rn[6]</td></tr>";}else{echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[3]</td><td>To</td><td>$rn[7]</td><td>$rn[8]</td><td>$rn[6]</td></tr>";}



}      

                         }else{echo "<tr><td>No Data Found</td></tr>";}echo"</table>";

echo"</div>";

     echo"<div id='d'>";

       echo"<button id='print-button'>Print</button><button id='exportButton'>Export to Excel</button>";

     echo"</div>";





}      

 

/*--4--*/

if($agency !='all' && $lb !='all') {$query = "SELECT al.tid,lb.name,lb.type,a.name,al.seg_weight,al.non_seg_weight,al.amount,al.invoice_id,al.invoice_date FROM lifting_invoice_status al INNER JOIN hks hk on al.hks_id=hk.id INNER JOIN mcf m ON hk.v1id=m.v1id INNER JOIN localbody lb ON m.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id INNER JOIN agency a ON al.agency_id=a.id WHERE aft.id=$aft AND lb.type='$lb' AND al.invoice='yes' AND al.payment='no' AND al.agency_id=$agency";

echo"<table>";

                     echo"<tr><td colspan='8'><h4>Filtered On Pending Payments</h4></td></tr><tr><td colspan='8'><h4>Area Facilitation Team: $aft_name | Local Body: $lb | Agency: $agency_name</h4></td></tr>";

                     $result = $conn->query($query);

                     if ($result->num_rows > 0) {

                     echo"<tr><th>Tid</th><th>Local Body<th>Type</th><th>Agency</th><th>Type</th><th>Invoice ID</th><th>Invoice Date</th><th>Amount</th></tr>";

                     while($rn=mysqli_fetch_array($result))

                         {       

                          if($rn[4] != 0){      

                          echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[3]</td><td>From</td><td>$rn[7]</td><td>$rn[8]</td><td>$rn[6]</td></tr>";}else{echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[3]</td><td>To</td><td>$rn[7]</td><td>$rn[8]</td><td>$rn[6]</td></tr>";}



}      

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

  printWindow.document.write('<html><head><title>Pending payments</title>');

  printWindow.document.write('<style>table { border-collapse: collapse; width: 100%; }');

  printWindow.document.write('table, th, td { border: 1px solid black; }</style></head><body>');

  printWindow.document.write('<h2>Local Body</h2>');

  printWindow.document.write(c.innerHTML);

  printWindow.document.write('</body></html>');

  printWindow.document.close();



  // Print the new window

  printWindow.print("Pending payments.pdf");

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

        a.download = "Pending payments.xls";

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