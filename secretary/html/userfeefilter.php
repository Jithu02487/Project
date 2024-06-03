<?php

require_once("../../connection/connection.php");

include("ssession.php");

if (isset($_SESSION['sid'])) {

//////////////////////////////////////////

include("commonheader.php");

include("footer.php");

/*-----------------------------------------*/

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

/*----------------------------------------*/





///////////////////////////////////////////

?>

<html>

<head>

      <title>district login</title>

      <link rel="stylesheet" type="text/css" href="../css/userfeefilter.css">

</head>

<body>



     <div id="b">

       <a href="userfee.php"><button type="submit">Filter<img src="..\images\filter.png"></button></a>

     </div>

     <div id="c">

        <?php

             if ($_SERVER["REQUEST_METHOD"] == "POST") {

                 

                 $from=$_POST["from_date"];

                 $to=$_POST["to_date"];



                  

/*-------------AFT AND LB------------------*/

   





/*-----------3--------------------------------------------------------------------*/





$query = "SELECT u.*,aft.name,lb.name,lb.type FROM user_fee u INNER JOIN localbody lb ON u.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id WHERE lb.id='$lb'"; 

echo"<table>";

                      echo"<tr><td colspan='18'><h4>User fee Collection details</h4></td></tr>";

$result = $conn->query($query);

if ($result->num_rows > 0) {

  echo"<tr><th>ID</th><th>Area Facelitation Team</th><th>Local Body</th><th>Type</th><th>Date of entry</th><th>No:wards</th><th>No:HKS-Members</th><th>No:Mini MCF</th><th>No:Active HH</th><th>No:HH Visited</th><th>% HH Coveraged</th><th>HH User Fee Collected</th><th>% Userfee collected HH</th><th>No:Active Institution</th><th>No:Visitied Institution</th><th>% Institution Coveraged</th><th>Institution User fee Collected</th><th>% Institution User fee Collected</th></tr>";

  while($rn=mysqli_fetch_array($result)){

  $p=($rn[8]/$rn[7])*100;

  $hh=(($rn[9]/$rn[6])/$rn[7])*100;

  $in=(($rn[12]/$rn[10])/$rn[15])*100;

  $pi=($rn[11]/$rn[10])*100;

  echo"<tr><td>$rn[0]</td><td>$rn[16]</td><td>$rn[17]</td><td>$rn[18]</td><td>$rn[1]</td><td>$rn[3]</td><td>$rn[4]</td><td>$rn[5]</td><td>$rn[7]</td><td>$rn[8]</td><td>$p%</td><td>$rn[9]</td><td>$hh%</td><td>$rn[10]</td><td>$rn[11]</td><td>$pi%</td><td>$rn[12]</td><td>$in%</td></tr>";

}}else{echo "<tr><td>No Data Found</td></tr>";}echo"</table>";

echo"</div>";



echo"<div id='d'>";

       echo"<button id='print-button'>Print</button><button id='exportButton'>Export to Excel</button>";

     echo"</div>";











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

  printWindow.document.write('<html><head><title>User Fee</title>');

  printWindow.document.write('<style>table { border-collapse: collapse; width: 100%; }');

  printWindow.document.write('table, th, td { border: 1px solid black; }</style></head><body>');

  printWindow.document.write('<h2>Local Body</h2>');

  printWindow.document.write(c.innerHTML);

  printWindow.document.write('</body></html>');

  printWindow.document.close();



  // Print the new window

  printWindow.print("User_Fee.pdf");

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

        a.download = "User_Fee.xls";

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

