<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
if(isset($_SESSION['urole']) && !empty($_SESSION['urole'])){}
else return;

include '../class/friends.php';
if($_REQUEST["action"]=="getusers"){
    $filter=$_REQUEST["filter"];
    getAllBuddies($filter);
}


?>
