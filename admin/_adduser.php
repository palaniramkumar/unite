<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
if ($_SESSION["urole"] == "Admin"  ){    }
else return;
require_once('../class/useroperation.php');

if($_REQUEST["action"]=="getallvaliduser"){
    $branch=$_REQUEST["branch"];
    $batch=$_REQUEST["batch"];
    $filter=$_REQUEST["filter"];
    $date=  trim( $_REQUEST["date"]);
    getAllValidUser($branch,$batch,'all',$filter,$date);
    
}
if($_REQUEST["action"]=="exportallvaliduser"){
    $branch=$_REQUEST["branch"];
    $batch=$_REQUEST["batch"];
    $filter=$_REQUEST["filter"];
    $date=  trim( $_REQUEST["date"]);
    ExportAllValidUser($branch,$batch,'all',$filter,$date);
    
}
if($_REQUEST["action"]=="updaterole"){
    $id=$_REQUEST["id"];
    $role=$_REQUEST["role"];
    updaterole($role,$id);
    
}
if($_REQUEST["action"]=="updateaccess"){
    $id=$_REQUEST["id"];
    $role=$_REQUEST["access"];
    updateaccess($role,$id);
    
}