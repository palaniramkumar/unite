<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once('../class/Event.php');

if($_REQUEST["action"]=="insert"){

if ($_SESSION["urole"] == "Admin"  ){    }
else return;
    $title=htmlspecialchars(mysql_escape_string($_REQUEST["title"]));
    $detail=htmlspecialchars(mysql_escape_string($_REQUEST["detail"]));
    $date=htmlspecialchars(mysql_escape_string($_REQUEST["date"]));
    $time=htmlspecialchars(mysql_escape_string($_REQUEST["time"]));
    $location=htmlspecialchars(mysql_escape_string($_REQUEST["location"]));
    $food=htmlspecialchars(mysql_escape_string($_REQUEST['food']));
    $transport=htmlspecialchars(mysql_escape_string($_REQUEST['transport']));
    $guest=htmlspecialchars(mysql_escape_string($_REQUEST['guest']));
    $poll=htmlspecialchars(mysql_escape_string($_REQUEST['poll']));
    $accommodation=htmlspecialchars(mysql_escape_string($_REQUEST['accommodation']));

    insertEvent($title, $detail, $date, $time, $location, $food, $transport, $guest,$poll,$accommodation);
    //echo 'Inserted';
}
if($_REQUEST["action"]=="updateevent"){

if ($_SESSION["urole"] == "Admin"  ){    }
else return;
    $title=htmlspecialchars(mysql_escape_string($_REQUEST["title"]));
    $detail=htmlspecialchars(mysql_escape_string($_REQUEST["detail"]));
    $date=htmlspecialchars(mysql_escape_string($_REQUEST["date"]));
    $time=htmlspecialchars(mysql_escape_string($_REQUEST["time"]));
    $location=htmlspecialchars(mysql_escape_string($_REQUEST["location"]));
    $food=htmlspecialchars(mysql_escape_string($_REQUEST['food']));
    $transport=htmlspecialchars(mysql_escape_string($_REQUEST['transport']));
    $guest=htmlspecialchars(mysql_escape_string($_REQUEST['guest']));
    $id=$_REQUEST['id'];
    $poll=htmlspecialchars(mysql_escape_string($_REQUEST['poll']));
    $accommodation=htmlspecialchars(mysql_escape_string($_REQUEST['accommodation']));

    updateEvent($id,$title, $detail, $date, $time, $location, $food, $transport, $guest,$poll,$accommodation);
    //echo 'Inserted';
}
if($_REQUEST["action"]=="attend"){
    $id=$_REQUEST["id"];
    $food=$_REQUEST['food'];
    $transport=$_REQUEST['transport'];
    $guest=$_REQUEST['guest'];
    $email=$_REQUEST['email'];
    $mobile=$_REQUEST['mobile'];
    $poll=htmlspecialchars(mysql_escape_string($_REQUEST['poll']));
    $accommodation=$_REQUEST['accommodation'];
    saveEventAttendies($id, $food, $transport, $guest,$poll,$accommodation,$mobile,$email);
    //echo 'Updated';
}
if($_REQUEST["action"]=="getallevent"){
    
    getAllEvent();
    
}
if($_REQUEST["action"]=="deleteevent"){
    $id=$_REQUEST["id"];
    deleteevent($id);
    
}
if($_REQUEST["action"]=="editevent"){
    $id=$_REQUEST["id"];
    editevent($id);
    
}
if($_REQUEST["action"]=="exportuser"){
    $id=$_REQUEST["id"];
    downloadEventUsers($id);
    
}
?>
