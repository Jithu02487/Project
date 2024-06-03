<?php

require_once("../../connection/connection.php");
include("ssession.php");

if (isset($_SESSION['sid'])) {

include("commonheader.php");

include("footer.php");





///////////////////////////////////////////

?>

<html>

<head>

      <title>Secretary login</title>

      <link rel="stylesheet" type="text/css" href="../css/chooseagency.css">

</head>

<body>

     

     <div id="b">





    <table id="tb">

      <tr><th  colspan="2">Choose Agency</th></tr>

      <form id="myForm" method="POST" action="choosedagency.php">

    <tr id="dropdown1Row"> <td> Agency </td><td><select name="agency" id="agency" >

                              <option value="">Not Selected</option>";

    <!--PHP FOR DROP DOWN-----!>

    <?php

     $query = "SELECT * FROM agency";

     $stmt = $conn->prepare($query);

    

     $stmt->execute();

     $result = $stmt->get_result();

     

     if (!$result) {

         die("Error: " . $conn->error);

     }

     if ($result->num_rows > 0) {

                             while($rn=mysqli_fetch_array($result))

                             {       

                              echo"<option value='$rn[0]'>$rn[1]</option>";}}?>



        </select> </td> </tr>

<tr><td colspan="2" id="tbt"><button type="submit" id="btn">Apply Agency</button></td></tr>

</table>







</div>



   <script>

const form = document.getElementById('myForm');

const dropdown = document.getElementById('agency');



form.addEventListener('submit', (event) => {

  if (dropdown.value === '') {

    event.preventDefault();

    alert('Please select an option');

  }

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