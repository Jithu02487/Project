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

      <link rel="stylesheet" type="text/css" href="../css/nonsegfilter.css">

</head>

<body>

     

     <div id="b">

       <a href="nonseg.php"><button type="submit">Filter<img src="..\images\filter.png"></button></a>

     </div>

     <div id="c">

        <?php

             if ($_SERVER["REQUEST_METHOD"] == "POST") {

                

                 $lb =$_POST["lb"];

                 $from=$_POST["from_date"];

                 $to=$_POST["to_date"];



/*-----------------------------------------*/

$q = "SELECT aft.id, aft.name FROM aft INNER JOIN aft_user au ON au.aft_id = aft.id WHERE au.id = ?";

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

/*---------------------out put set----------------------*/      



/*--------------------------filter------------------------------------------*/



/*-------------AFT AND LB------------------*/

/*--1--*/

if($lb =='all') {

$c=0;

$query = "SELECT lb.name,lb.type,SUM(al.non_seg_weight) AS nseg,SUM(al.seg_weight) FROM lifting_invoice_status al INNER JOIN hks hk on al.hks_id=hk.id INNER JOIN mcf m ON hk.v1id=m.v1id INNER JOIN localbody lb ON m.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id WHERE aft.id=$aft AND al.date_of_request >= '$from' AND al.date_of_request <= '$to' GROUP BY aft.name,lb.name ORDER BY nseg DESC";

echo"<table>";

                     echo"<tr><td colspan='4'><h4>Filtered On</h4></td></tr><tr><td colspan='4'><h4>Area Facilitation Team:$aft_name | Local Body:$lb</h4></td></tr><tr><td colspan='4'><h4>From : $from | To: $to</h4></td></tr>";

                     $result = $conn->query($query);

                     $res = $conn->query($query);

/*////////////////////////////////////////////////*/

if ($result->num_rows > 0) {while($rnn=mysqli_fetch_array($result)){if($rnn[2]>$rnn[3]){ $c=1;}}}

if($c !=0){

/*////////////////////////////////////////////////////*/

                     if ($res->num_rows > 0) {

                     echo"<tr><th>Local Body</th><th>Type</th><th>None-Seggregated(KG)</th><th>Seggregated(KG)</th></tr>";

                     while($rn=mysqli_fetch_array($res))

                         {       

                          if($rn[2]>$rn[3]){

                          echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[3]</td></tr>";}}      

                         }echo"</table>";

echo"</div>";

     echo"<div id='d'>";

       echo"<button id='print-button'>Print</button><button id='exportButton'>Export to Excel</button>";

     echo"</div>";

}       

else{echo "<tr><td colspan='4'>No Data Found</td></tr>";}echo"</table>";}

 

/*--2--*/

if($lb !='all') {

$c=0;

$query = "SELECT lb.name,lb.type,SUM(al.non_seg_weight) AS nseg,SUM(al.seg_weight) FROM lifting_invoice_status al INNER JOIN hks hk on al.hks_id=hk.id INNER JOIN mcf m ON hk.v1id=m.v1id INNER JOIN localbody lb ON m.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id WHERE aft.id=$aft AND lb.type='$lb' AND al.date_of_request >= '$from' AND al.date_of_request <= '$to' GROUP BY aft.name,lb.name ORDER BY nseg DESC";

echo"<table>";

                      echo"<tr><td colspan='4'><h4>Filtered On</h4></td></tr><tr><td colspan='4'><h4>Area Facilitation Team:$aft_name | Local Body:$lb</h4></td></tr><tr><td colspan='4'><h4>From : $from | To: $to</h4></td></tr>";

                     $result = $conn->query($query);

                     $res = $conn->query($query);

/*////////////////////////////////////////////////*/

if ($result->num_rows > 0) {while($rnn=mysqli_fetch_array($result)){if($rnn[2]>$rnn[3]){ $c=1;}}}

if($c !=0){

/*////////////////////////////////////////////////////*/

                     if ($res->num_rows > 0) {

                     echo"<tr><th>Local Body</th><th>Type</th><th>None-Seggregated(KG)</th><th>Seggregated(KG)</th></tr>";

                     while($rn=mysqli_fetch_array($res))

                         {       

                          if($rn[2]>$rn[3]){

                          echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[3]</td></tr>";}}      

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

  printWindow.print("lb_with_high_nonsegregated_waste.pdf");

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