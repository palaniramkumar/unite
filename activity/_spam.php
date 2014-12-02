<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_SESSION['urole']) && !empty($_SESSION['urole'])){}
else return;

if($_REQUEST["action"]=="reportspam"){
    require_once('../class/spam.php');
    $type=$_REQUEST["type"];
    $id=$_REQUEST["id"];
    reportspam($type,$id);
}
?>