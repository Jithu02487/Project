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

      <link rel="stylesheet" type="text/css" href="../css/acceptancepending.css">

</head>

<body>



<!-----------------div 2-----------------------!>

<div id="b">

    <table id="tb">

      <tr><th  colspan="2">Lifting Request Acceptance Pending</th></tr>

      <form id="myForm" method="POST" action="acceptancefilter.php">

    <tr id="dropdown1Row"> <td> Agency </td><td><select name="agency" id="agency" onchange="toggleDropdown()" >

                              <option value="">Not Selected</option>";

    <!--PHP FOR DROP DOWN-----!>

    <?php

     $query = "SELECT * FROM agency";

     $result = $conn->query($query);

     if (!$result) {

        die("Error: " . $conn->error);

    }

     if ($result->num_rows > 0) {

            echo"<option value='all'>ALL</option>";

                             while($rn=mysqli_fetch_array($result))

                             {       

                              echo"<option value='$rn[0]'>$rn[1]</option>";}}?>

<!---------------------------!>

        </select> </td> </tr>



    <tr id="dropdown2Row"> <td> Area Facilitation Team </td> 

         <td><select name="aft" id="dropdown1" onchange="toggleDropdown2()">

         <option value="">Not Selected</option>";

<!--PHP FOR DROP DOWN-----!>

<?php

     $query = "SELECT * FROM aft";

     $result = $conn->query($query);

     if (!$result) {

        die("Error: " . $conn->error);

    }

     if ($result->num_rows > 0) {

            echo"<option value='all'>ALL</option>";

                             while($rn=mysqli_fetch_array($result))

                             {       

                              echo"<option value='$rn[0]'>$rn[1]</option>";}}?>

<!---------------------------!>

        </select> </td></tr>

<tr id="rowDropdown2" style="display: none;">

<td> Local Body Type </td>

<td><select name="lb" id="type">

                                      <option value="all">ALL</option>

                                      <option value="ULB">Urban Local Body</option>

                                      <option value="RLB">Rural Local Body</option></select></td> 

</tr>

<tr><td colspan="2" id="tbt"><button type="submit" id="btn">Apply Filter</button></td></tr>

</table>  

</div>

<script>

        function toggleDropdown() {

                                    var dropdown1 = document.getElementById("agency");

        if (dropdown1.value != "") {

            dropdown2Row.classList.add("hidden");

        } else {

            dropdown2Row.classList.remove("hidden");

        }



}





    function toggleDropdown2() {

        // Get the selected value from dropdown1

        var dropdown1 = document.getElementById("dropdown1");

             if (dropdown1.value != "") {

            dropdown1Row.classList.add("hidden");

        } else {

            dropdown1Row.classList.remove("hidden");

        }

        var selectedValue = dropdown1.options[dropdown1.selectedIndex].value;



        // Display the row for dropdown2 if a selection is made in dropdown1

        rowDropdown2.style.display = (selectedValue !== "") ? "table-row" : "none";}

</script>

</body>

</html>

<?php

}

else {

    header('Location:../../Login-System/login/sessiondestory.php');

}

?>