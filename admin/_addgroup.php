<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
if ($_SESSION["urole"] == "Admin"  ){    }
else return;
require_once('../class/usergroups.php');

if($_REQUEST["action"]=="getallgroups"){
    
    getAllGroup();
    
}
if($_REQUEST["action"]=="update"){
    $id=$_REQUEST["id"];
    $groupname=$_REQUEST["groupname"];
    updateGroup($id,$groupname);
}
if($_REQUEST["action"]=="add"){
    $groupname=mysql_escape_string($_REQUEST["groupname"]);
    $about=  mysql_escape_string($_REQUEST["about"]);
    addGroup($groupname,$about);
    
}
if($_REQUEST["action"]=="delete"){
    $id=$_REQUEST["id"];
    deleteGroup($id);
}