<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

require_once('../class/opensource.php');

if($_REQUEST["action"]=="addproduct"){
    if ($_SESSION["urole"] == "Admin"  ){    }
    else return;
    $name= mysql_escape_string($_REQUEST["name"]);
    $about= mysql_escape_string($_REQUEST["about"]);
    $image= mysql_escape_string($_REQUEST["image"]);
    $url= mysql_escape_string($_REQUEST["url"]);
    insertProductProfile($name,$about,$image,$url);
    
}
if($_REQUEST["action"]=="getproduct"){
   
   getProductProfile();
}
if($_REQUEST["action"]=="delete"){
        if ($_SESSION["urole"] == "Admin"  ){    }
    else return;
    $id=$_REQUEST["id"];
    deleteProductProfile($id);
    
}
