<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */
 session_start();
if(isset($_SESSION['uname']))
  unset($_SESSION['uname']);
if(isset($_SESSION['uid']))
  unset($_SESSION['uid']);
if(isset($_SESSION['urole']))
  unset($_SESSION['urole']);
if(isset($_SESSION['token']))
  unset($_SESSION['token']);

//echo '<script>alert("hey")</script>';
@include("./class/CommonMethod.php");
movePage(301,"./index.php");
?>

Logging out ...
