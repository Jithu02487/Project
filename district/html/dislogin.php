<html>

<head>
      <title>district login</title>
      <link rel="stylesheet" type="text/css" href="../css/dislogin.css">
     <script type="text/javascript">

    </script>
</head>
<body>

     <div id="a">
          <h1>FORWARD LINKAGE SYSTEM</h1>
     </div>


     <div id="b">
        <form id="c" action="..\php\dislogaction.php" method="post" autocomplete="off">
            <h2>USER-LOGIN</h2>
            <b>USERNAME</b>
            <input type="text" placeholder="Username" required name="username" autocomplete="off">
            <b>PASSWORD</b>
            <input type="password" placeholder="Password" required name="password" autocomplete="off">
            <button type="submit"><b>Log In</b></button>
<?php
    if (isset($_GET["login_error"]) && $_GET["login_error"] == 1) {
        echo '<p>Invalid username or password. Please try again.</p>';
    }
    ?>
        </form>
      </div>

</body>

</html>