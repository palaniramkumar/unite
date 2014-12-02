<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function getusercount($filter){
    $sql="select count(rowid) from alumnireg";
    if($filter=='NONPROFILE')
            $sql="select count(rowid) from alumnireg where role='Pending'";
    else if($filter=='UNVERIFIED')
            $sql="select count(rowid) from alumnireg where verified=0";
    else if($filter=='VERIFIED')
            $sql="select count(rowid) from alumnireg where verified=1";
    else if($filter=='POST')
            $sql="select count(id) from post where Priority not like 'Admin'";
    else if($filter=='STORY')
            $sql="select count(id) from SSNClicks where role not like 'Admin'";
    require_once('dbConnection.php');
    $db = new dbConnection();
    $con = $db->getConnection();
    //echo $sql;
    //Execute insert query
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
    $count=0;
    if($row = mysqli_fetch_array($result))
            $count=$row[0];
    
    mysqli_close($con);
    return $count;
   
}
function updateadminstatus($field,$value){
    $sql="update admin set flag='$value' where feature='$field'";
    //echo $sql;
    require_once('dbConnection.php');

    $db = new dbConnection();
    $con = $db->getConnection();

    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
    mysqli_close($con);
    
}
