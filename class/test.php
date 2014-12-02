<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function Pass4Dummy(){
    require_once('dbConnection.php');
    require_once('sendmail.php');
    require_once('CommonMethod.php');
    
    $db = new dbConnection();
    $con = $db->getConnection();
    //$sql="select fname,email,rowid from alumnireg where role='Alumni' and password=''";
	$sql="SELECT fname,email,rowid FROM alumnireg where gender is NULL and oauth='' and auth_code='0' order by rowid desc";
    $result = mysqli_query($con, $sql);
    $db1 = new dbConnection();
    $con1 = $db1->getConnection();
    while($row = mysqli_fetch_array($result)) {
        $authcode=  genPassword(15);
        $email=$row['email'];
        $to= array();
        $to[0]=$email;
         $temp="Dear ".$row['fname'].", <br/>Our Sincere Appologize. We have reset you password to ".$authcode."<br/>Please use your email id and the new password to login or even you can use facebook / Google OAUTH ";
       
         sendinlinemail("Unite - Password Modified", $temp."<br/><br/>Access your account by simply open this link <a href='http://ssnunite.com/activity/changepassword.php'>Access My Account</a> <br/> or, simple copy paste this URL in your webbrowser. URL: 'http://ssnunite.com/activity/changepassword.php", $to);
       
        $sql="update alumnireg set password=password('$authcode') where rowid=".$row['rowid'];
	
        $result1 = mysqli_query($con1, $sql);
        if (!$result1) {
            die('Invalid query: ' .$sql);
        }
	
        //echo "Sent mail to ".$email."<br/>";
    }
mysqli_close($con1);
mysqli_close($con);
}
Pass4Dummy();
