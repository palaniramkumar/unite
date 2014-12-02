<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
if(isset($_SESSION['urole']) && !empty($_SESSION['urole'])){}
else return;

require_once('../class/ssnclick.php');
if($_REQUEST["action"]=="deletestory"){
    $id=$_REQUEST["id"];
    deleteStory($id);
    //echo 'Deleted';
}
if($_REQUEST["action"]=="insertstory"){
    $image=$_REQUEST["imagepath"];
    $msg=$_REQUEST["msg"];
    insertStory($image, $msg);
    //echo 'Inserted';
}
if($_REQUEST["action"]=="viewstory"){
    displayStory($_REQUEST["filter"],$_SESSION["uid"],$_REQUEST["page"]);
    //echo 'selected';
}
?>
