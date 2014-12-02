<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

function changepassword($id,$password) {
        require_once('dbConnection.php');
        $db = new dbConnection();
        $con = $db->getConnection();
      
        $result = mysqli_query($con, "update alumnireg set `password`=password('$password') where rowid=$id"); //write the password validation
        
        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
      
        mysqli_close($con);
    }
function updatefield($field,$value,$id) {
        require_once('dbConnection.php');
        $db = new dbConnection();
        $con = $db->getConnection();
        
        if($field=="dob")
        {
            $value = date("Y-m-d", strtotime($value));
        }
      
        $result = mysqli_query($con, "update alumnireg set `$field`='$value' where rowid=$id"); //write the password validation
        
        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
      
        mysqli_close($con);
    }

function forgotpassword($email) {
        require_once('dbConnection.php');
        require_once('CommonMethod.php');
        require_once('sendmail.php');
        $db = new dbConnection();
        $con = $db->getConnection();
        $authcode=  genPassword(15);
        $sql="update alumnireg set auth_code='$authcode' where email='$email' ";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            die('Invalid query: ' . $sql);
        }
        if($result==0){
            return "email is not registered to this portal";
        }
        else{
            $msg="Kindly click the this <a href='http://ssnunite.com/passwordreset.php?email=$email&authcode=$authcode'>link</a> to reset your password.";
            $array = array($email);
            sendinlinemail("Reset Password", $msg, $array);
            return "Please check your mail.";
        }
      
        mysqli_close($con);
}
function createDummyAccount($user, $password,$verified=0) {
    require_once('dbConnection.php');
    require_once('sendmail.php');
    require_once('CommonMethod.php');
    $authcode=  genPassword(15);
    $db = new dbConnection();
    $con = $db->getConnection();
   $sql = "insert into alumnireg (username,regdate,email,oauth,verified,password,role,auth_code) values ('$user',now(),'$user','Web',$verified,password('$password'),'Invalid','$authcode')";
          
    //echo $sql;
    //Execute insert query
    $result = mysqli_query($con, $sql);

    if (mysqli_errno($con) == 1062) {
        die($user.' may already associatted with someother account.If you lost the password/<b>ACTIVATION</b> link, please click Forget Password!');
    }

    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }

    mysqli_close($con);
    $_SESSION["urole"] = "Alumni";
    $temp="";
    if($verified==1){
        $temp="<h3>Your Friend has Refered You To join the SSN UNITE</h3><h3>Your Password for this account is ".$password."</h3>";
    }
    $email= array();
    $email[0]=$user;
    echo ('Check SPAM ! Please verify your email id by clicking the verfication link. This mail may be filtered as SPAM by your email provider. ');
    
    sendinlinemail("Please Verify Your Account", $temp."<br/>Please verify your account by simply click this link <a href='http://ssnunite.com/authorizeme.php?email=$user&authcode=$authcode'>Validate My Account</a> <br/> or, simple copy paste this URL in your webbrowser. URL: 'http://ssnunite.com/authorizeme.php?email=$user&authcode=$authcode'", $email);
}

function updateprofile($fname, $lname, $dob, $gender, $branch, $batch, $org, $desig, $higherstudies, $country, $mobile, $address, $experiance, $id) {
    $role="Alumni";
    if($batch==0)
        $role="Faculty";
    else if($batch>date("Y"))
        $role="Student";
    $sql = "UPDATE `alumnireg`
SET

`fname` = '$fname',
`lname` = '$lname',
`gender` = '$gender',
`dob` = STR_TO_DATE('$dob', '%d-%m-%Y'),
`branch` = '$branch',
`batch` = '$batch',
`org` = '$org',
`desig` = '$desig',
`country` = '$country',
`number` = '$mobile',
`address` = '$address',
`higherstudies`='$higherstudies',
 `experiance`='$experiance',
 role='$role' 
WHERE rowid=$id;
";
$file = fopen("Registration.log","a+");
fwrite($file,"[".date('m/d/Y h:i:s a', time())."]SQL : $sql\n");
fclose($file);

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
	$_SESSION['uname']=$fname;
    mysqli_close($con);
    $_SESSION["urole"] = "Alumni";
    $array = array($_SESSION["email"]);
    sendinlinemail("Your" . "! Account Created", "Account is created successfully. You can start using the website by clicking <a href='http://ssnunite.com'>Here</a>", "$array");
}
$file = fopen("Registration.log","a+");
fwrite($file,"[".date('m/d/Y h:i:s a', time())."]REQUEST URI : $_SERVER[REQUEST_URI]\n");
fclose($file);

?>
