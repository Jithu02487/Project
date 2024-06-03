<?php
     require_once("dbconnect.php");
     $username = $_POST["username"];
     $password = $_POST["password"];

// prepared statement to avoid SQL injection
     $query = "select * from login where email='$username' and password='$password'";
     $result = $conn->query($query);
     if ($result->num_rows > 0){
// output data of each row
     while ($row = $result->fetch_row()) {

       $role=$row[2];
}

       if($role == 2)
          {
//prepared statement to avoid SQL injection
           $query = "select * from district where email='$username'";
           $result = $conn->query($query);
           if ($result->num_rows > 0){
// output data of each row
           while ($row = $result->fetch_row()) {
             $did=$row[0];}}
     //section start
     session_start();
     $_SESSION['did']=$did;                                     
//----------------
//----------------------------------------
          header("Location: ../html/dishome.php");
          }
       else if($role == 3)
          {
           //prepared statement to avoid SQL injection
           $query = "select * from aft_user where email='$username'";
           $result = $conn->query($query);
           if ($result->num_rows > 0){
// output data of each row
           while ($row = $result->fetch_row()) {
             $auid=$row[0];}}
     //section start
     session_start();
     $_SESSION['auid']=$auid; 
           header("Location: ../html/afthome.php");
          }

else if($role == 4)
          {
           //prepared statement to avoid SQL injection
           $query = "select * from secretary where email='$username'";
           $result = $conn->query($query);
           if ($result->num_rows > 0){
// output data of each row
           while ($row = $result->fetch_row()) {
             $sid=$row[0];}}
     //section start
     session_start();
     $_SESSION['sid']=$sid; 
           header("Location: ../html/sechome.php");
          }}

     else{
           header("Location: ../html/login.php?login_error=1");
}     

