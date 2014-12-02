<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
if ($_SESSION["urole"] == "Admin"  ){    }
else return;
require_once('../class/adminstatus.php');

if($_REQUEST["action"]=="changeflag"){
    $field=$_REQUEST["field"];
    $value=$_REQUEST["value"];
    updateadminstatus($field,$value);
    
}