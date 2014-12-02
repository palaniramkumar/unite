<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
if(isset($_SESSION['urole']) && !empty($_SESSION['urole'])){}
else return;


require_once('../class/chatter.php');
if($_REQUEST["action"]=="getallconversations"){
   
    $ownerid=$_SESSION['uid'];
    getAllThreads( $ownerid);
    //echo 'Inserted';
}
if($_REQUEST["action"]=="getConv"){
    $id=$_REQUEST["user"];
    getThread($id);
    //echo 'selected';
}
if($_REQUEST["action"]=="deleteconversation"){
    $id=$_REQUEST["id"];
    deletemsg($id);
    //echo 'selected';
}
if($_REQUEST["action"]=="insert"){
    $msg=mysql_escape_string($_REQUEST["msg"]);
    $senderid=$_REQUEST["senderid"];
    insertmsg($msg,$senderid);
    //echo 'selected';
}
?>
