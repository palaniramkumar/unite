<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
$email = $_REQUEST["email"];
$code = $_REQUEST["authcode"];
$sql = "select rowid from alumnireg where email='$email' and auth_code='$code' and auth_code not in ('facebook','google')";
require_once('./class/dbConnection.php');
require_once('./class/CommonMethod.php');
$db = new dbConnection();
$con = $db->getConnection();
//echo $sql;
//Execute insert query
$result = mysqli_query($con, $sql);

if (!$result) {
    die('Invalid query: ' . mysql_error());
}
if ($row = mysqli_fetch_array($result)) {
    $sql = "update  alumnireg  set role='Pending' where email='$email'";
    $_SESSION['urole'] = "Pending";
    $_SESSION['uid']=$row['rowid'];
    require_once('./class/dbConnection.php');

    $db = new dbConnection();
    $con = $db->getConnection();
//    echo $sql;
//Execute insert query
    $result = mysqli_query($con, $sql);
    mysqli_close($con);
    movePage("301", "index.php");
    
} else {
    echo "Token Invalid. e-mail validation failed!";
}
mysqli_close($con);
?>
