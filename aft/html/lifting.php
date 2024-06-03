<?php

require_once("../../connection/connection.php");

include("aftsession.php");

if (isset($_SESSION['auid'])) {

$username=$_SESSION['username'];

//////////////////////////////////////////

include("footer.php");





///////////////////////////////////////////

?>



<html>

<head>

      <title>district login</title>

      

       <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

      <link rel="stylesheet" type="text/css" href="../css/lifting.css">

</head>

<body>



     <div id="a">

          <a href=""><h1>FORWARD-LINKAGE-DISTRICT USER</h1>

     </div>

     <div id="b">

       <a href="dishome.php"><button type="submit">Home</button></a>

       <a href="disprofile.php"><button type="submit">User: <?php echo"$username";?></button></a>

       <a href="dislogin.php"><button type="submit">Log Out</button></a>

     </div>

     <div id="c">

        <form method="POST">

        <h2>Lifting Pending</h2>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <label>AGENCY</label>

<!---------------------------------------------------------------------------PHP FOR DROP DOWN-----!>

<?php

     $query = "SELECT * FROM agency";

     $result = $conn->query($query);

     if (!$result) {

      die("Error in query: " . $conn->error);

    }

     if ($result->num_rows > 0) {

     echo"<select name='agency' id='d'>";

            echo"<option value='all'>ALL</option>";

                             while($rn=mysqli_fetch_array($result))

                             {       

                              echo"<option value='$rn[0]'>$rn[0]</option>";}}?>

<!-----------------------------------------------------------------------------------------!>

        </select>

            <label>HKS</label>

<!---------------------------------------------------------------------------PHP FOR 2ND DROPDOWN---------!>

<?php

     $query = "SELECT * FROM hks";

     $result = $conn->query($query);

     if (!$result) {

      die("Error in query: " . $conn->error);

    }

     if ($result->num_rows > 0) {

     echo"<select name='hks' id='d'>";

            echo"<option value='all'>ALL</option>";

                             while($rn=mysqli_fetch_array($result))

                             {       

                              echo"<option value='$rn[0]'>$rn[0]</option>";}}?>

<!---------------------------------------------------------------------------------------------------------!>

        </select>

            <label>LOCAL BODIES</label>

<!--------------------------------------------------------------------------------------PHP FOR 3RD DROP DOWN----------!>

<?php

     $query = "SELECT * FROM localbodies";

     $result = $conn->query($query);

     if (!$result) {

      die("Error in query: " . $conn->error);

    }

     if ($result->num_rows > 0) {

     echo"<select name='localbody' id='d'>";

            echo"<option value='all'>ALL</option>";

                             while($rn=mysqli_fetch_array($result))

                             {       

                              echo"<option value='$rn[2]'>$rn[0]</option>";}}?>

<!----------------------------------------------------------------------------------------------------------------!>

        </select>

        <button type="submit">APPLY</button>

    </form>

      </div>





<div id="e">

<!-------------------------------------PHP code for fetch details-----------------------!>

<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $agency = $_POST["agency"];

            $hks = $_POST["hks"];

            $lb = $_POST["localbody"];

            if($agency == 'all' && $hks == 'all' && $lb == 'all')

             {$query = "SELECT * FROM aap";}



            elseif ($agency == 'all' && $hks != 'all' && $lb != 'all')

             {$query = "SELECT * FROM aap WHERE hks = '$hks' AND localbodies = '$lb'";}



            elseif ($agency == 'all' && $hks == 'all' && $lb != 'all')

             {$query = "SELECT * FROM aap WHERE localbodies = '$lb'";}



            elseif ($agency == 'all' && $hks != 'all' && $lb == 'all')

             {$query = "SELECT * FROM aap WHERE hks = '$hks'";}



           elseif ($agency != 'all' && $hks == 'all' && $lb != 'all')

             {$query = "SELECT * FROM aap WHERE agency = '$agency' AND localbodies = '$lb'";}



           elseif ($agency != 'all' && $hks == 'all' && $lb == 'all')

             {$query = "SELECT * FROM aap WHERE agency = '$agency'";}



          elseif ($agency != 'all' && $hks != 'all' && $lb == 'all')

             {$query = "SELECT * FROM aap WHERE agency = '$agency' AND hks = '$hks'";}



          elseif ($agency != 'all' && $hks != 'all' && $lb != 'all')

             {$query = "SELECT * FROM aap WHERE hks = '$hks' AND localbodies = '$lb' AND agency = '$agency'";}

            else{echo "no pending acceptance";}

          $result = $conn->query($query);

//----------------table-------------

if ($result->num_rows > 0) {

        echo"<table>";

        echo"<tr><th>Transcaton ID</th><th>Agency</th><th>HKS</th><th>Local Bodi ID</th></tr>";

        while($rn=mysqli_fetch_array($result))

         {       

          echo"<tr><td>$rn[1]</td><td>$rn[3]</td><td>$rn[4]</td><td>$rn[5]</td></tr>";}}

           

    }

    echo"</table>";

?>

           

<!--------------------------------------------------------------------------------------!>

<button onclick="generatePDF()">Download PDF</button>



   

</div>

<script>

        function generatePDF() {

            const doc = new jsPDF();



            doc.text("Table Heading", 10, 10);

            doc.autoTable({ html: '#table' });

            doc.save('table.pdf');

        }

    </script>

</body>



</html>

<?php

}

else {

    header('Location:../../Login-System/login/sessiondestory.php');

}

?>