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

      <link rel="stylesheet" type="text/css" href="../css/nonsegfilter.css">

</head>

<body>



     <div id="b">

       <a href="nonseg.php"><button type="submit">Filter<img src="..\images\filter.png"></button></a>

     </div>

     <div id="c">

        <?php

             if ($_SERVER["REQUEST_METHOD"] == "POST") {

                 $aft =$_POST["aft"];

                 $lb =$_POST["lb"];

                 $from=$_POST["from_date"];

                 $to=$_POST["to_date"];



                  if($aft !="" && $aft !="all")

                     {

                      $query = "SELECT name FROM aft WHERE id=?";

                      $stmt = $conn->prepare($query);

                      $stmt->bind_param("i", $aft); // Assuming $aft is an integer, adjust the type accordingly

                      $stmt->execute();

                      $result = $stmt->get_result();

                      

                      if (!$result) {

                          die("Error: " . $conn->error);

                      }

                         while($rn=mysqli_fetch_array($result))

                         {  $aft_name=$rn[0];}

                     }

/*---------------------out put set----------------------*/      



/*--------------------------filter------------------------------------------*/



/*-------------AFT AND LB------------------*/

/*--1--*/

if($aft=='all' && $lb=='all') {$query = "SELECT aft.name,lb.name,lb.type,SUM(al.non_seg_weight) AS nseg,SUM(al.seg_weight) FROM lifting_invoice_status al INNER JOIN hks hk on al.hks_id=hk.id INNER JOIN mcf m ON hk.v1id=m.v1id INNER JOIN localbody lb ON m.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id WHERE al.date_of_request >= '$from' AND al.date_of_request <= '$to' GROUP BY aft.name,lb.name ORDER BY nseg DESC";

echo"<table>";

$c=0;

                     echo"<tr><td colspan='5'><h4>LSGD With Non-Segregated Than Segregated Waste-Filtered On</h4></td></tr><tr><td colspan='5'><h4>AFT:$aft | Local Body:$lb</h4></td></tr><tr><td colspan='5'><h4>From : $from | To: $to</h4></td></tr>";

                     $result = $conn->query($query);

                     $res = $conn->query($query);

/*////////////////////////////////////////////////*/

if ($result->num_rows > 0) {while($rnn=mysqli_fetch_array($result)){if($rnn[3]>$rnn[4]){ $c=1;}}}

if($c !=0){

/*////////////////////////////////////////////////////*/

                     if ($res->num_rows > 0) {

                     echo"<tr><th>Area Facelitation Team</th><th>Local Body</th><th>Type</th><th>None-Seggregated(KG)</th><th>Seggregated(KG)</th></tr>";

                     while($rn=mysqli_fetch_array($res))

                         {       

                          if($rn[3]>$rn[4]){

                          echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[3]</td><td>$rn[4]</td></tr>";}}      

                         }echo"</table>";

echo"</div>";

     echo"<div id='d'>";

       echo"<button id='print-button'>Print</button><button id='exportButton'>Export to Excel</button>";

     echo"</div>";

}       

else{echo "<tr><td colspan='5'>No Data Found</td></tr>";}echo"</table>";}

/*--2--*/

if($aft=='all' && $lb!='all') {$query = "SELECT aft.name,lb.name,lb.type,SUM(al.non_seg_weight) AS nseg,SUM(al.seg_weight) FROM lifting_invoice_status al INNER JOIN hks hk on al.hks_id=hk.id INNER JOIN mcf m ON hk.v1id=m.v1id INNER JOIN localbody lb ON m.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id WHERE lb.type='$lb' AND al.date_of_request >= '$from' AND al.date_of_request <= '$to' GROUP BY aft.name,lb.name ORDER BY nseg DESC";

$c=0;

echo"<table>";

                      echo"<tr><td colspan='5'><h4>LSGD With Non-Segregated Than Segregated Waste-Filtered On</h4></td></tr><tr><td colspan='5'><h4>AFT:$aft | Local Body:$lb</h4></td></tr><tr><td colspan='5'><h4>From : $from | To: $to</h4></td></tr>";

                     $result = $conn->query($query);

                     $res = $conn->query($query);

/*////////////////////////////////////////////////*/

if ($result->num_rows > 0) {while($rnn=mysqli_fetch_array($result)){if($rnn[3]>$rnn[4]){ $c=1;}}}

if($c !=0){

/*////////////////////////////////////////////////////*/

                     if ($res->num_rows > 0) {

                     echo"<tr><th>Area Facelitation Team</th><th>Local Body</th><th>Type</th><th>None-Seggregated(KG)</th><th>Seggregated(KG)</th></tr>";

                     while($rn=mysqli_fetch_array($res))

                         {       

                          if($rn[3]>$rn[4]){

                          echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[3]</td><td>$rn[4]</td></tr>";}}      

                         }echo"</table>";

echo"</div>";

     echo"<div id='d'>";

       echo"<button id='print-button'>Print</button><button id='exportButton'>Export to Excel</button>";

     echo"</div>";

}       

else{echo "<tr><td colspan='5'>No Data Found</td></tr>";}echo"</table>";}



/*--3--*/

if($aft !='all' && $aft !='' && $lb =='all') {

$c=0;

$query = "SELECT aft.name,lb.name,lb.type,SUM(al.non_seg_weight) AS nseg,SUM(al.seg_weight) FROM lifting_invoice_status al INNER JOIN hks hk on al.hks_id=hk.id INNER JOIN mcf m ON hk.v1id=m.v1id INNER JOIN localbody lb ON m.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id WHERE aft.id=$aft AND al.date_of_request >= '$from' AND al.date_of_request <= '$to' GROUP BY aft.name,lb.name ORDER BY nseg DESC";

echo"<table>";

                     echo"<tr><td colspan='5'><h4>LSGD With Non-Segregated Than Segregated Waste-Filtered On</h4></td></tr><tr><td colspan='5'><h4>AFT:$aft_name | Local Body:$lb</h4></td></tr><tr><td colspan='5'><h4>From : $from | To: $to</h4></td></tr>";

                     $result = $conn->query($query);

                     $res = $conn->query($query);

/*////////////////////////////////////////////////*/

if ($result->num_rows > 0) {while($rnn=mysqli_fetch_array($result)){if($rnn[3]>$rnn[4]){ $c=1;}}}

if($c !=0){

/*////////////////////////////////////////////////////*/

                     if ($res->num_rows > 0) {

                     echo"<tr><th>Area Facelitation Team</th><th>Local Body</th><th>Type</th><th>None-Seggregated(KG)</th><th>Seggregated(KG)</th></tr>";

                     while($rn=mysqli_fetch_array($res))

                         {       

                          if($rn[3]>$rn[4]){

                          echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[3]</td><td>$rn[4]</td></tr>";}}      

                         }echo"</table>";

echo"</div>";

     echo"<div id='d'>";

       echo"<button id='print-button'>Print</button><button id='exportButton'>Export to Excel</button>";

     echo"</div>";

}       

else{echo "<tr><td colspan='5'>No Data Found</td></tr>";}echo"</table>";}

 

/*--4--*/

if($aft !='all' && $aft !='' && $lb !='all') {

$c=0;

$query = "SELECT aft.name,lb.name,lb.type,SUM(al.non_seg_weight) AS nseg,SUM(al.seg_weight) FROM lifting_invoice_status al INNER JOIN hks hk on al.hks_id=hk.id INNER JOIN mcf m ON hk.v1id=m.v1id INNER JOIN localbody lb ON m.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id WHERE aft.id=$aft AND lb.type='$lb' AND al.date_of_request >= '$from' AND al.date_of_request <= '$to' GROUP BY aft.name,lb.name ORDER BY nseg DESC";

echo"<table>";

                      echo"<tr><td colspan='5'><h4>LSGD With Non-Segregated Than Segregated Waste-Filtered On</h4></td></tr><tr><td colspan='5'><h4>AFT:$aft_name | Local Body:$lb</h4></td></tr><tr><td colspan='5'><h4>From : $from | To: $to</h4></td></tr>";

                     $result = $conn->query($query);

                     $res = $conn->query($query);

/*////////////////////////////////////////////////*/

if ($result->num_rows > 0) {while($rnn=mysqli_fetch_array($result)){if($rnn[3]>$rnn[4]){ $c=1;}}}

if($c !=0){

/*////////////////////////////////////////////////////*/

                     if ($res->num_rows > 0) {

                     echo"<tr><th>Area Facelitation Team</th><th>Local Body</th><th>Type</th><th>None-Seggregated(KG)</th><th>Seggregated(KG)</th></tr>";

                     while($rn=mysqli_fetch_array($res))

                         {       

                          if($rn[3]>$rn[4]){

                          echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[3]</td><td>$rn[4]</td></tr>";}}      

                         }echo"</table>";

echo"</div>";

     echo"<div id='d'>";

       echo"<button id='print-button'>Print</button><button id='exportButton'>Export to Excel</button>";

     echo"</div>";

}       

else{echo "<tr><td colspan='5'>No Data Found</td></tr>";}echo"</table>";}

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

  printWindow.document.write('<html><head><title>lb_with_high_nonsegregated_waste</title>');

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

        a.download = "lb_with_high_nonsegregated_waste.xls";

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