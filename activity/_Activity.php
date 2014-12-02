<?php

session_start();
if(isset($_SESSION['urole']) && !empty($_SESSION['urole'])){}
else return;
require_once('../class/Activity.php');


if($_REQUEST["action"]=="loadtweetasgrid"){
    showtweetasgrid($_REQUEST["filter"],$_REQUEST["groupid"],$_REQUEST["page"]);
}
if($_REQUEST["action"]=="addgrouptweet"){
    $msg=mysql_escape_string($_REQUEST["msg"]);
    addTweet($msg,$_REQUEST["groupid"]);
  
}
if($_REQUEST["action"]=="addvideo"){
    $msg=  htmlspecialchars(mysql_escape_string($_REQUEST["msg"]));
    addTweet($msg,"video");
}
if($_REQUEST["action"]=="addtweet"){
    $msg=mysql_escape_string($_REQUEST["msg"]);
    addTweet($msg);
  
}
if($_REQUEST["action"]=="loadtweet"){
    showtweet($_REQUEST["filter"],$_REQUEST["page"]);
    
}
if($_REQUEST["action"]=="loadsingletweet"){
    showsingletweet($_REQUEST["id"]);
}
if($_REQUEST["action"]=="commenttweet"){
    $tweetid=$_REQUEST["tweetid"];
    $msg=mysql_escape_string($_REQUEST["msg"]);
    addActivityComment($tweetid, $msg);
}
if($_REQUEST["action"]=="deletecomment"){
    $id=$_REQUEST["id"];
    deleteActivityComment($id);
}
if($_REQUEST["action"]=="deletetweet"){
    $id=$_REQUEST["id"];
    deleteTweet($id);
}
?>
