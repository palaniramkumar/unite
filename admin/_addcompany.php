<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

require_once('../class/company.php');

if($_REQUEST["action"]=="addcompany"){
    if ($_SESSION["urole"] == "Admin"  ){    }
    else return;
    $name= mysql_escape_string($_REQUEST["name"]);
    $about= mysql_escape_string($_REQUEST["about"]);
    $image= mysql_escape_string($_REQUEST["image"]);
    $url= mysql_escape_string($_REQUEST["url"]);
    insertCompanyProfile($name,$about,$image,$url);
    
}
if($_REQUEST["action"]=="getcompany"){
   
   getCompanyProfile();
}
if($_REQUEST["action"]=="delete"){
        if ($_SESSION["urole"] == "Admin"  ){    }
    else return;
    $id=$_REQUEST["id"];
    deleteCompanyProfile($id);
    
}
