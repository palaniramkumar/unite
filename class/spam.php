<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
function reportspam($type,$id) {
        require_once('dbConnection.php');
        require_once('CommonMethod.php');
        
        $sql = "insert into spam_reports (userid,type,reportee,ip,timestamp) values('$id','$type','$_SESSION[uid]','".  get_client_ip()."',now())";
        //echo $sql;
        
        $db = new dbConnection();
        $con = $db->getConnection();
        echo $sql;
        //Execute insert query
        $result = mysqli_query($con, $sql);

        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }

        mysqli_close($con);
    }
    ?>

