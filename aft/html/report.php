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

      <title>district login</title>

      <link rel="stylesheet" type="text/css" href="../css/report.css">

</head>

<body>

   

     <!-----------------div 2-----------------------!>

<div id="b">

    <table id="tb">

      <tr><th  colspan="2">Report Filter Option</th></tr>

      <form id="myForm" method="POST" action="reportfilter.php">

      <tr><td>From</td><td><input type="date" id="from_date" name="from_date" required>

      <tr><td>To</td><td><input type="date" id="to_date" name="to_date" max="<?php echo date('Y-m-d'); ?>" required></td>

<tr><td colspan="2" id="tbt"><button type="submit" id="btn">Apply Filter</button></td></tr>

</table>

</form>





</div>

<script>

const form = document.getElementById('myForm');

const fromDateInput = document.getElementById('from_date');

const toDateInput = document.getElementById('to_date');



form.addEventListener('submit', (event) => {

  const fromDate = new Date(fromDateInput.value).getTime();

  const toDate = new Date(toDateInput.value).getTime();



  if (toDate < fromDate) {

    event.preventDefault();

    alert('To date cannot be earlier than from date');

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