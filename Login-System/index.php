<?php

//index.php

//Include Configuration File
include('config.php');

$login_button = '';


if(isset($_GET['code']))
{
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);


 if(!isset($token['error']))
 {
 
  $google_client->setAccessToken($token['access_token']);

 
  $_SESSION['access_token'] = $token['access_token'];


  $google_service = new Google_Service_Oauth2($google_client);

 
  $data = $google_service->userinfo->get();

 
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
 }
}


if(!isset($_SESSION['access_token']))
{

//  $login_button = '<a href="'.$google_client->createAuthUrl().'">Login With Google</a>';

 header("Location: " . $google_client->createAuthUrl());
exit();


}

?>

  
   <?php
   if($login_button == '')
   {
    require 'assets/setup/db.inc.php';
    
    if(isset($_SESSION['user_email_address'])){
        $email=$_SESSION['user_email_address'];
        session_start();
        $query = "select * from users where email='$email'";
                        $result = $conn->query($query);
                    if ($result->num_rows > 0){
                        while ($row = $result->fetch_row()) {
                            $user_type=$row[6];}}
                        
    
                        // DISTRICT login--------------------------------------------
             if($user_type=="district"){
                $query = "select * from district where email='$email'";
                $result = $conn->query($query);
                if ($result->num_rows > 0){
     // output data of each row
                while ($r = $result->fetch_row()) {
                  $did=$r[0];}}
          //section start
          session_start();
          $_SESSION['did']=$did; 
                header("Location: ../district/html/dishome.php");
            exit();
            }
    
    // V1 login--------------------------------------------
            if($user_type=="v1"){ 
                $query = "select * from verifier_one where v1_email='$email'";
                $result = $conn->query($query);
                if ($result->num_rows > 0){
                // output data of each row
                while ($row = $result->fetch_row()) {
                $id=$row[0];}}
                //section start
                $_SESSION['v1id']=$id;
                $_SESSION['email']=$eml;
                // header("Location: ../../../v1/logedin.php");
                header("Location: ../v1/v1front.php");
            exit();
            }
    
    // V2 login--------------------------------------------
            if($user_type=="v2"){
                $query = "select * from verifier_two where v2_email='$email'";
                $result = $conn->query($query);
                if ($result->num_rows > 0){
                // output data of each row
                while ($row = $result->fetch_row()) {
                $id=$row[0];}}
                //section start
                $_SESSION['id']=$id;
                header("Location: ../../../v2/v2front.php");
            exit();
            }
    
    // AFT login--------------------------------------------
            if($user_type=="aft"){
                $query = "select * from aft_user where email='$email'";
                $result = $conn->query($query);
                if ($result->num_rows > 0){
                // output data of each row
                while ($row = $result->fetch_row()) {
                $auid=$row[0];}
                 //section start
                 $_SESSION['auid']=$auid;
                 header("Location: ../aft/html/afthome.php");
             exit();
            }else{
                echo "<script>alert('No rows found');</script>";
                }
               
            }
    
    
    // SECRETARY login--------------------------------------------
            if($user_type=="secretary"){
                $query = "select * from secretary where email='$email'";
                $result = $conn->query($query);
                if ($result->num_rows > 0){
                // output data of each row
                while ($row = $result->fetch_row()) {
                    $sid=$row[0];}}
            //section start
            session_start();
            $_SESSION['sid']=$sid;
                header("Location: f-linkage\secretary\html\sechome.php");
            exit();
            }
    
            // HKS LOGIN ------------------------------------------
    if($user_type=="hks"){
    $query = "select * from hks where email='$email'";
    $result = $conn->query($query);
    if ($result->num_rows > 0){
    // output data of each row
    while ($row = $result->fetch_row()) {
        $sid=$row[0];}}
    //section start
    session_start();
    $_SESSION['sid']=$sid;
    header("Location: ../../../hks/hksfront.php");
    exit();
    }
    
    // AGENCY LOGIN ------------------------------------------
    if($user_type=="agency"){
    $query = "select * from agency where email='$email'";
    $result = $conn->query($query);
    if ($result->num_rows > 0){
    // output data of each row
    while ($row = $result->fetch_row()) {
        $id=$row[0];}}
    //section start
    session_start();
    $_SESSION['id']=$id;
    header("Location: ../Agency_in/index.php");
    exit();
    }
    
    // ADMIN LOGIN -------------------------------------
    if($user_type=="admin"){
    
    $_SESSION['a']=1;
    
    header("Location: ../admin/admin_dashboard.php");
    
    exit();
    
    }
                               
                    }else{
                        echo 'user not registered';
                    }
    
        }else {
            echo "not set";
        }
   ?>
