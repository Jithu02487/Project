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

      <link rel="stylesheet" type="text/css" href="../css/localbodyfilter.css">

</head>

<body>

     

     <div id="b">

       <a href="localbodies.php"><button type="submit">Filter<img src="..\images\filter.png"></button></a>

     </div>

     <div id="c">

        <?php

             if ($_SERVER["REQUEST_METHOD"] == "POST") {  

                 

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

              $r = $stmt->get_result();

              

              if (!$r) {

                  die("Error in query: " . $stmt->error);

              }

              

              if ($r->num_rows > 0) {

                                                           while($re=mysqli_fetch_array($r)){

                                                                                           $aftid=$re[0];

                                                                                            $nam=$re[1];

                                                           }}

                 $lb= $_POST["lb"];

/*---------------------out put set----------------------*/      



/*--------------------------filter------------------------------------------*/

             /*-1-*/                  if($lb == 'all') { 

                                                           



                                                           $query = "SELECT lb.type,lb.name FROM aft a INNER JOIN localbody lb on a.id=lb.aft_id WHERE a.id='$aftid'"; }



            /*-2-*/                     elseif($lb != 'all') { 

              $q = "SELECT name FROM aft WHERE id = ?";

              $stmt = $conn->prepare($q);

              

              if (!$stmt) {

                  die("Error in preparing statement: " . $conn->error);

              }

              

              // Bind the parameter

              $stmt->bind_param("s", $aftid);

              

              // Execute the query

              $stmt->execute();

              

              // Get the result

              $r = $stmt->get_result();

              

              if (!$r) {

                  die("Error in query: " . $stmt->error);

              }

              

              if ($r->num_rows > 0) {

                                                           while($re=mysqli_fetch_array($r)){

                                                                                            $nam=$re[0];

                                                           }}





                                                        $query = "SELECT lb.type,lb.name FROM aft a INNER JOIN localbody lb on a.id=lb.aft_id WHERE a.id='$aftid' AND lb.type='$lb'"; }



                else{echo "<table><tr><td>No Data Found</td></tr></table>";}

/*-----------------------fetching result on table--------------------*/

                 $result = $conn->query($query);

                 if ($result->num_rows > 0) {

                     echo"<table>";

                     echo"<tr><td colspan='2'><h4>Local Bodies-Filtered On</h4></td></tr><td colspan='2'><h4>Area Fecilitation Team :$nam | Local Body: $lb</h4></td></tr>";



                     echo"<tr><th colspan='2'>Local Body</th></tr>";

                     echo"<tr><td>Type</td><td>Name</td></tr>";

                     while($rn=mysqli_fetch_array($result))

                         {       

                          echo"<tr><td>$rn[0]</td><td>$rn[1]</td></tr>";}      

                         

                     echo"</table>";

         echo"</div>";

     echo"<div id='d'>";

      echo"<button id='print-button'>Print</button><button id='exportButton'>Export to Excel</button>";

     echo"</div>";

}else{echo "<table><tr><td>No Data Found</td></tr></table>";}

}?>





<script>

document.getElementById("print-button").addEventListener("click", function () {

  // Get the content div

  var contentDiv = document.getElementById("c");



  // Create a new window for printing

  var printWindow = window.open('', '', 'width=600,height=600');

  

  // Write the content of the div to the new window

  printWindow.document.open();

  printWindow.document.write('<html><head><title>Localbody_list</title>');

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

        a.download = "Localbody_list.xls";

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