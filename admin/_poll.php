<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

require_once('../class/poll.php');

if($_REQUEST["action"]=="insert"){
    if ($_SESSION["urole"] == "Admin"  ){    }
    else return;
    $question=htmlspecialchars(($_REQUEST["question"]));
    $choice=htmlspecialchars(mysql_real_escape_string($_REQUEST["choice"]));
    
    $priority=$_SESSION['urole'];
    $ownerid=$_SESSION['uid'];
    $ownername=$_SESSION['uname'];

    insertPoll($question, $choice, $priority, $ownerid, $ownername);
    //echo 'Inserted';
}
if($_REQUEST["action"]=="vote"){
    $id=htmlspecialchars(($_REQUEST["id"]));
    $ans=htmlspecialchars(($_REQUEST["ans"]));

    answerPoll($id, $ans);
    //echo 'voted';
}
if($_REQUEST["action"]=="result"){
    $id=$_REQUEST["id"];
    resultPoll($id);
    //echo 'loaded';
}
if($_REQUEST["action"]=="getallpoll"){
  
    getAllpoll();
  
}
if($_REQUEST["action"]=="toggle"){

    $id=$_REQUEST["id"];
    togglepoll($id);
  
}
if($_REQUEST["action"]=="deletepoll"){
if ($_SESSION["urole"] == "Admin"  ){    }
else return;
    $id=$_REQUEST["id"];
    deletepoll($id);
  
}
?>
