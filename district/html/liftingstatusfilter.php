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

      <link rel="stylesheet" type="text/css" href="../css/liftingstatusfilter.css">

</head>

<body>



     <div id="b">

       <a href="liftingstatus.php"><button type="submit">Filter<img src="..\images\filter.png"></button></a>

     </div>

     <div id="c">

        <?php

             if ($_SERVER["REQUEST_METHOD"] == "POST") {

                 $agency =$_POST["agency"];

                 $from=$_POST["from_date"];

                 $to=$_POST["to_date"];

                 if($agency == ""){

                                $aft = $_POST["aft"]; }

                  else{ $aft ="";}

                 if($agency !="" && $agency !="all"){

                  $query = "SELECT name FROM agency WHERE id=?";

                  $stmt = $conn->prepare($query);

                  $stmt->bind_param("i", $agency); // Assuming $agency is an integer, adjust the type accordingly

                  $stmt->execute();

                  $result = $stmt->get_result();

                  

                  if (!$result) {

                      die("Error: " . $conn->error);

                  }

                                   while($rn=mysqli_fetch_array($result))

                                   {  $agency_name=$rn[0];}

                                   

                                                      }

                   else{$agency_name=$agency;}  

                 if($aft != ""){

                                $lb = $_POST["lb"]; }

                  else{ $lb ="";}

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

/*-1-*/    if($agency == '' && $aft == '' && $lb == '') {

                    echo"<table>";

                    echo "<tr><td><center>Nothing Selected</center></td></tr></table>";

} 

/*-2-*/    if($agency == 'all') {$query = "SELECT al.tid,aft.name,lb.name,lb.type,hk.hks_name,a.name,al.date_of_request,al.date_of_acceptance,al.date_of_lifting,al.quantity,al.seg_weight,al.non_seg_weight FROM lifting_invoice_status al INNER JOIN hks hk on al.hks_id=hk.id INNER JOIN mcf m ON hk.v1id=m.v1id INNER JOIN localbody lb ON m.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id INNER JOIN agency a ON al.agency_id=a.id WHERE al.date_of_request >= '$from' AND al.date_of_request <= '$to'";

               echo"<table>";

                     echo"<tr><td colspan='12'><h4>Lifting Status-Filtered On</h4></td></tr><tr><td colspan='12'><h4>Agency:$agency_name</h4></td></tr><tr><td colspan='12'><h4>From : $from | To: $to</h4></td></tr>";

                 $result = $conn->query($query);

                 if ($result->num_rows > 0) {



                     echo"<tr><th>Tid</th><th>Area Facelitation Team</th><th>Local Body<th>Type</th></th><th>Agency</th><th>Date of Request</th><th>Date of Acceptance</th><th>Date of Lifting</th><th>Quantity Lifted</th><th>Waste Type</th><th>Weight</th></tr>";

                     while($rn=mysqli_fetch_array($result))

                         {

                          if($rn[10] !=0 || $rn[11] !=0){    

                          if($rn[10]!=0){$waste='Segregated';$w=$rn[10];} else if($rn[11]!=0){$waste='Non-Segregated';$w=$rn[11];}

                          echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[3]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td><td>$rn[8]</td><td>$rn[9]</td><td>$waste</td><td>$w kg</td></tr>";} 

                          else{echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[3]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td><td>$rn[8]</td><td>$rn[9]</td><td colspan = '2'>Invoice Pending</tr>";} }    

                         }else{echo "<tr><td>No Data Found</td></tr>";}echo"</table>";

echo"</div>";

     echo"<div id='d'>";

       echo"<button id='print-button'>Print</button><button id='exportButton'>Export to Excel</button>";

     echo"</div>";





}

/*-----------------------------------------------------*/





/*-3-*/    

if($agency != 'all' && $agency != '') 

{$query = "SELECT al.tid,aft.name,lb.name,lb.type,hk.hks_name,a.name,al.date_of_request,al.date_of_acceptance,al.date_of_lifting,al.quantity,al.seg_weight,al.non_seg_weight FROM lifting_invoice_status al INNER JOIN hks hk on al.hks_id=hk.id INNER JOIN mcf m ON hk.v1id=m.v1id INNER JOIN localbody lb ON m.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id INNER JOIN agency a ON al.agency_id=a.id WHERE al.agency_id=$agency AND al.date_of_request >= '$from' AND al.date_of_request <= '$to'";



             

/*-----------------------fetching result on table--------------------*/

                     echo"<table>";

                     echo"<tr><td colspan='12'><h4>Lifting Status-Filtered On</h4></td></tr><td colspan='12'><h4>Agency:$agency_name</h4></td></tr><tr><td colspan='12'><h4>From : $from | To: $to</h4></td></tr>";

                 $result = $conn->query($query);

                 if ($result->num_rows > 0) {



                     echo"<tr><th>Tid</th><th>Area Facelitation Team</th><th>Local Body<th>Type</th></th><th>Agency</th><th>Date of Request</th><th>Date of Acceptance</th><th>Date of Lifting</th><th>Quantity Lifted</th><th>Waste Type</th><th>Weight</th></tr>";

                     while($rn=mysqli_fetch_array($result))

                         {       

                          if($rn[10] !=0 || $rn[11] !=0){    

                          if($rn[10]!=0){$waste='Segregated';$w=$rn[10];} else if($rn[11]!=0){$waste='Non-Segregated';$w=$rn[11];}

                          echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[3]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td><td>$rn[8]</td><td>$rn[9]</td><td>$waste</td><td>$w kg</td></tr>";} 

                          else{echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[3]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td><td>$rn[8]</td><td>$rn[9]</td><td colspan = '2'>Invoice Pending</tr>";} }  

                         }else{echo "<tr><td>No Data Found</td></tr>";}echo"</table>";

                    echo"</div>";

     echo"<div id='d'>";

       echo"<button id='print-button'>Print</button><button id='exportButton'>Export to Excel</button>";

     echo"</div>";





}

/*-------------AFT AND LB------------------*/

/*--4--*/

if($aft=='all' && $lb=='all') 

{$query = "SELECT al.tid,aft.name,lb.name,lb.type,hk.hks_name,a.name,al.date_of_request,al.date_of_acceptance,al.date_of_lifting,al.quantity,al.seg_weight,al.non_seg_weight FROM lifting_invoice_status al INNER JOIN hks hk on al.hks_id=hk.id INNER JOIN mcf m ON hk.v1id=m.v1id INNER JOIN localbody lb ON m.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id INNER JOIN agency a ON al.agency_id=a.id WHERE al.date_of_request >= '$from' AND al.date_of_request <= '$to'";

echo"<table>";

                     echo"<tr><td colspan='12'><h4>Lifting Status-Filtered On</h4></td></tr><tr><td colspan='12'><h4>AFT:$aft | Local Body:$lb</h4></td></tr><tr><td colspan='12'><h4>From : $from | To: $to</h4></td></tr>";

                     $result = $conn->query($query);

                     if ($result->num_rows > 0) {

                     echo"<tr><th>Tid</th><th>Area Facelitation Team</th><th>Local Body<th>Type</th></th><th>Agency</th><th>Date of Request</th><th>Date of Acceptance</th><th>Date of Lifting</th><th>Quantity Lifted</th><th>Waste Type</th><th>Weight</th></tr>";

                     while($rn=mysqli_fetch_array($result))

                         {                                 

                          if($rn[10] !=0 || $rn[11] !=0){    

                          if($rn[10]!=0){$waste='Segregated';$w=$rn[10];} else if($rn[11]!=0){$waste='Non-Segregated';$w=$rn[11];}

                          echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[3]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td><td>$rn[8]</td><td>$rn[9]</td><td>$waste</td><td>$w kg</td></tr>";} 

                          else{echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[3]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td><td>$rn[8]</td><td>$rn[9]</td><td colspan = '2'>Invoice Pending</tr>";} }    

                         }else{echo "<tr><td>No Data Found</td></tr>";}echo"</table>";

echo"</div>";

     echo"<div id='d'>";

       echo"<button id='print-button'>Print</button><button id='exportButton'>Export to Excel</button>";

     echo"</div>";





}         

/*--5--*/

if($aft=='all' && $lb!='all') {$query = "SELECT al.tid,aft.name,lb.name,lb.type,hk.hks_name,a.name,al.date_of_request,al.date_of_acceptance,al.date_of_lifting,al.quantity,al.seg_weight,al.non_seg_weight FROM lifting_invoice_status al INNER JOIN hks hk on al.hks_id=hk.id INNER JOIN mcf m ON hk.v1id=m.v1id INNER JOIN localbody lb ON m.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id INNER JOIN agency a ON al.agency_id=a.id WHERE lb.type='$lb' AND al.date_of_request >= '$from' AND al.date_of_request <= '$to'";

echo"<table>";

                     echo"<tr><td colspan='12'><h4>Lifting Status-Filtered On</h4></td></tr><tr><td colspan='12'><h4>AFT:$aft | Local Body:$lb</h4></td></tr><tr><td colspan='12'><h4>From : $from | To: $to</h4></td></tr>";

                     $result = $conn->query($query);

                     if ($result->num_rows > 0) {

                     echo"<tr><th>Tid</th><th>Area Facelitation Team</th><th>Local Body<th>Type</th></th><th>Agency</th><th>Date of Request</th><th>Date of Acceptance</th><th>Date of Lifting</th><th>Quantity Lifted</th><th>Waste Type</th><th>Weight</th></tr>";

                     while($rn=mysqli_fetch_array($result))

                         {       

                          if($rn[10] !=0 || $rn[11] !=0){    

                          if($rn[10]!=0){$waste='Segregated';$w=$rn[10];} else if($rn[11]!=0){$waste='Non-Segregated';$w=$rn[11];}

                          echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[3]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td><td>$rn[8]</td><td>$rn[9]</td><td>$waste</td><td>$w kg</td></tr>";} 

                          else{echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[3]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td><td>$rn[8]</td><td>$rn[9]</td><td colspan = '2'>Invoice Pending</tr>";} }    

                         }else{echo "<tr><td>No Data Found</td></tr>";}echo"</table>";

echo"</div>";

     echo"<div id='d'>";

       echo"<button id='print-button'>Print</button><button id='exportButton'>Export to Excel</button>";

     echo"</div>";



}         



/*--6--*/

if($aft !='all' && $aft !='' && $lb =='all') 

{$query = "SELECT al.tid,aft.name,lb.name,lb.type,hk.hks_name,a.name,al.date_of_request,al.date_of_acceptance,al.date_of_lifting,al.quantity,al.seg_weight,al.non_seg_weight FROM lifting_invoice_status al INNER JOIN hks hk on al.hks_id=hk.id INNER JOIN mcf m ON hk.v1id=m.v1id INNER JOIN localbody lb ON m.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id INNER JOIN agency a ON al.agency_id=a.id WHERE aft.id=$aft AND al.date_of_request >= '$from' AND al.date_of_request <= '$to'";

echo"<table>";

                     echo"<tr><td colspan='12'><h4>Lifting Status-Filtered On</h4></td></tr><tr><td colspan='12'><h4>AFT:$aft_name | Local Body:$lb</h4></td></tr><tr><td colspan='12'><h4>From : $from | To: $to</h4></td></tr>";

                     $result = $conn->query($query);

                     if ($result->num_rows > 0) {

                    echo"<tr><th>Tid</th><th>Area Facelitation Team</th><th>Local Body<th>Type</th></th><th>Agency</th><th>Date of Request</th><th>Date of Acceptance</th><th>Date of Lifting</th><th>Quantity Lifted</th><th>Waste Type</th><th>Weight</th></tr>";

                     while($rn=mysqli_fetch_array($result))

                         {       

                          if($rn[10] !=0 || $rn[11] !=0){    

                          if($rn[10]!=0){$waste='Segregated';$w=$rn[10];} else if($rn[11]!=0){$waste='Non-Segregated';$w=$rn[11];}

                          echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[3]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td><td>$rn[8]</td><td>$rn[9]</td><td>$waste</td><td>$w kg</td></tr>";} 

                          else{echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[3]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td><td>$rn[8]</td><td>$rn[9]</td><td colspan = '2'>Invoice Pending</tr>";} }    

                         }else{echo "<tr><td>No Data Found</td></tr>";}echo"</table>";

echo"</div>";

     echo"<div id='d'>";

       echo"<button id='print-button'>Print</button><button id='exportButton'>Export to Excel</button>";

     echo"</div>";





}         

 

/*--7--*/

if($aft !='all' && $aft !='' && $lb !='all') 

{$query = "SELECT al.tid,aft.name,lb.name,lb.type,hk.hks_name,a.name,al.date_of_request,al.date_of_acceptance,al.date_of_lifting,al.quantity,al.seg_weight,al.non_seg_weight FROM lifting_invoice_status al INNER JOIN hks hk on al.hks_id=hk.id INNER JOIN mcf m ON hk.v1id=m.v1id INNER JOIN localbody lb ON m.lb_id=lb.id INNER JOIN aft ON lb.aft_id=aft.id INNER JOIN agency a ON al.agency_id=a.id WHERE aft.id=$aft AND lb.type='$lb' AND al.date_of_request >= '$from' AND al.date_of_request <= '$to'";

echo"<table>";

                     echo"<tr><td colspan='12'><h4>Lifting Status-Filtered On</h4></td></tr><tr><td colspan='12'><h4>AFT:$aft_name | Local Body:$lb</h4></td></tr><tr><td colspan='12'><h4>From : $from | To: $to</h4></td></tr>";

                     $result = $conn->query($query);

                     if ($result->num_rows > 0) {

                     echo"<tr><th>Tid</th><th>Area Facelitation Team</th><th>Local Body<th>Type</th></th><th>Agency</th><th>Date of Request</th><th>Date of Acceptance</th><th>Date of Lifting</th><th>Quantity Lifted</th><th>Waste Type</th><th>Weight</th></tr>";

                     while($rn=mysqli_fetch_array($result))

                         {       

                          if($rn[10] !=0 || $rn[11] !=0){    

                          if($rn[10]!=0){$waste='Segregated';$w=$rn[10];} else if($rn[11]!=0){$waste='Non-Segregated';$w=$rn[11];}

                          echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[3]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td><td>$rn[8]</td><td>$rn[9]</td><td>$waste</td><td>$w kg</td></tr>";} 

                          else{echo"<tr><td>$rn[0]</td><td>$rn[1]</td><td>$rn[2]</td><td>$rn[3]</td><td>$rn[5]</td><td>$rn[6]</td><td>$rn[7]</td><td>$rn[8]</td><td>$rn[9]</td><td colspan = '2'>Invoice Pending</tr>";} }    

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

  printWindow.document.write('<html><head><title>Lifting_status</title>');

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

        a.download = "Lifting_status.xls";

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