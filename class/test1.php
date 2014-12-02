<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
        $sql = "SELECT * from alumnireg where role='Invalid' order by rowid desc ";
        require_once('dbConnection.php');
        require_once('sendmail.php');
        $db = new dbConnection();
        $con = $db->getConnection();
        echo $sql;
        //Execute insert query
        $result = mysqli_query($con, $sql);

        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
try
  {
        while ($row = mysqli_fetch_array($result)) {
            $to= array();
            $to[0]=$row[email];
            $url="http://ssnunite.com/authorizeme.php?email=$row[email]&authcode=$row[auth_code]";
            $msg="Please verify your account by simply click this <a href='$url'>link</a> Validate My Account or, simple copy paste this URL in your webbrowser.<br/>URL: $url";
		
            sendinlinemail("[SSN Alumni] Gentle Remainder - Verify Account", $msg, $to);
            echo "Invite Sent to ".$row["email"]."<br/>";
	}
}
catch(Exception $e)
  {
  echo 'Message: ' .$e->getMessage();
  }
        
        mysqli_close($con);
?>
