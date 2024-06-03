<?php

require_once("../../connection/connection.php");


include("ssession.php");

if (isset($_SESSION['sid'])) {

    $agency =$_POST["agency"];

    $query = "SELECT sec.id, aft.name AS aft_name, aft.id AS aft_id, lb.name AS localbody_name, lb.id AS localbody_id 
              FROM secretary sec 
              INNER JOIN localbody lb ON sec.lb_id = lb.id 
              INNER JOIN aft ON lb.aft_id = aft.id 
            --   INNER JOIN agency_localbody al ON al.lb_id = sec.lb_id 
            --   INNER JOIN agency a ON al.agency_id = a.id
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
    }
    
    ///////////////////////////////////////////
    $query7 = "SELECT  a.name
    FROM secretary sec 
    INNER JOIN localbody lb ON sec.lb_id = lb.id 
    INNER JOIN aft ON lb.aft_id = aft.id 
    INNER JOIN agency_localbody alb ON sec.lb_id = alb.lb_id 
    INNER JOIN agency a ON alb.agency_id = a.id 
    WHERE sec.id = ?";
    $stmt = $conn->prepare($query7);
    $stmt->bind_param("i", $sid); // Assuming $sid is an integer, adjust the type accordingly
    $stmt->execute();
    $result = $stmt->get_result();
    
    if (!$result) {
    die("Error: " . $conn->error);
    }
         if ($result->num_rows > 0){
    // output data of each row
         while ($row = $result->fetch_row()) {
    
            $q = "UPDATE agency_localbody SET agency_id=? WHERE lb_id=?";
            $stmt = $conn->prepare($q);
            $stmt->bind_param("ii", $agency, $lb); 
              }} 
              else{       
                $q = "INSERT INTO agency_localbody (agency_id, lb_id) VALUES (?, ?)";
                $stmt = $conn->prepare($q);
                $stmt->bind_param("ii", $agency, $lb);
                
            }
    
    ///////////////////////////////////////////
    
    #$q = "UPDATE agency_localbody SET agency_id=? WHERE lb_id=?";
    #$stmt = $conn->prepare($q);
    #$stmt->bind_param("ii", $agency, $lb); 
    
    if ($stmt->execute()){
    echo"<script>alert('Agency updated')</script>";
    header("Location:sechome.php");
    }
    
    }
    else {
        header('Location:../../Login-System/login/sessiondestory.php');
    }
    ?>