<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);*/
include '../class/registration.php';
if($_REQUEST["action"]=="update"){
    $fname=  mysql_escape_string($_REQUEST["fname"]);
    $lname=mysql_escape_string($_REQUEST["lname"]);
    $dob=mysql_escape_string($_REQUEST["dob"]);
    $gender=mysql_escape_string($_REQUEST["gender"]);
    $branch=mysql_escape_string(htmlspecialchars($_REQUEST["branch"]));
    $batch=mysql_escape_string(htmlspecialchars($_REQUEST["batch"]));
    $org=mysql_escape_string($_REQUEST["org"]);
    $desig=mysql_escape_string(htmlspecialchars($_REQUEST["desig"]));
    $higherstudies=mysql_escape_string($_REQUEST["higherstudies"]);
    $country=mysql_escape_string(htmlspecialchars($_REQUEST["country"]));
    $mobile=mysql_escape_string($_REQUEST["mobile"]);
    $address=mysql_escape_string(htmlspecialchars($_REQUEST["address"]));
    $experiance=mysql_escape_string($_REQUEST["experiance"]);
$file = fopen("Registration.log","a+");
fwrite($file,"[".date('m/d/Y h:i:s a', time())."]$fname,$lname,$dob,$gender,$branch,$batch,$org,$desig,$higherstudies,$country,$mobile,$address,$experiance,$_SESSION[uid]\n");
fclose($file);
    updateprofile($fname,$lname,$dob,$gender,$branch,$batch,$org,$desig,$higherstudies,$country,$mobile,$address,$experiance,$_SESSION["uid"]);


}
if($_REQUEST["action"]=="singlefieldupdate"){
    $field=$_REQUEST["field"];
    $value=mysql_escape_string($_REQUEST["value"]);
    updatefield($field,$value,$_SESSION["uid"]);
}
if($_REQUEST["action"]=="createdummy"){
    $user=$_REQUEST["user"];
    $password=$_REQUEST["pass"];
    
    createDummyAccount($user, $password) ;
}
if($_REQUEST["action"]=="invitefriend"){
    $email=$_REQUEST["email"];
    createDummyAccount($email, "password1",1) ;
}
if($_REQUEST["action"]=="changepassword"){
    $password=$_REQUEST["password"];
    changepassword($_SESSION["uid"], $password) ;
}
if($_REQUEST["action"]=="resetpassword"){
    $email=$_REQUEST["email"];
    forgotpassword($email) ;
}
?>
