<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

require_once('../class/post.php');

if(isset($_SESSION['urole']) && !empty($_SESSION['urole'])){}
else return;

if($_REQUEST["action"]=="insert"){

define('PUN_DEBUG', 1);
define('PUN_SHOW_QUERIES', 1);
    $head=htmlspecialchars(mysql_escape_string($_REQUEST["title"]));
    $summary=htmlspecialchars(mysql_escape_string($_REQUEST["summary"]));
    $desc=htmlspecialchars(mysql_escape_string($_REQUEST["desc"]));
    $tags=htmlspecialchars(mysql_escape_string($_REQUEST["tags"]));
    $imagepath=$_REQUEST["image"];
    $priority=$_SESSION['urole'];
    $ownerid=$_SESSION['uid'];
    $ownername=$_SESSION['uname'];
    
    insertPost($head, $summary, $desc, $tags, $imagepath, $priority, $ownerid, $ownername);
    echo 'Inserted';
}
if($_REQUEST["action"]=="getallpost"){
    $ownerid=$_SESSION['uid'];
    $filter=$_REQUEST['filter'];
    $source=$_REQUEST['source'];

    if($_REQUEST['source']!=NULL)
        getallpost($ownerid,$filter,$source);
    
    else if($_REQUEST['filter']!=NULL)
        getallpost($ownerid,$filter);
    
    else
         getallpost($ownerid);
}
if($_REQUEST["action"]=="deletepost"){
    $id=$_REQUEST["id"];
    deletepost($id);
}
if($_REQUEST["action"]=="togglepost"){
    $id=$_REQUEST["id"];
    togglepost($id);
}
if($_REQUEST["action"]=="editpost"){
    $id=$_REQUEST["id"];
    editpost($id);
}
if($_REQUEST["action"]=="updatepost"){
    $id=$_REQUEST["id"];
    $head=htmlspecialchars(mysql_escape_string($_REQUEST["title"]));
    $summary=htmlspecialchars(mysql_escape_string($_REQUEST["summary"]));
    $desc=htmlspecialchars(mysql_escape_string($_REQUEST["desc"]));
    $tags=htmlspecialchars(mysql_escape_string($_REQUEST["tags"]));
    $imagepath=$_REQUEST["image"];
    updatepost($id, $head, $summary, $desc, $tags, $imagepath);
}
if($_REQUEST["action"]=="insertcomment"){
   
    $eventid=$_REQUEST["id"];
    $comment=htmlspecialchars(mysql_escape_string($_REQUEST["comment"]));
    $role=$_SESSION['urole'];
    $ownerid=$_SESSION['uid'];
    $ownername=$_SESSION['uname'];

    insertComment($eventid, $comment, $role, $ownerid, $ownername);
    //echo 'Inserted';
}
if($_REQUEST["action"]=="deletecomment"){
    $id=$_REQUEST["id"];
    $role=$_SESSION['urole'];
    $ownerid=$_SESSION['uid'];
    deleteComment($id, $role, $ownerid);
    //echo 'Inserted';
}
if($_REQUEST["action"]=="getcomment"){
    
    $eventid=$_REQUEST["id"];
    getComment($eventid);
    //echo 'selected';
}
?>
