<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
function getAllThreads( $id){
    require_once('dbConnection.php');
    require_once('CommonMethod.php');
   //$sql="SELECT * FROM chatter where (toid = $_SESSION[uid] or fromid = $_SESSION[uid]) and (toid = $id or fromid = $id); ";
   $sql="select a.fname,a.rowid,date_format(max(c.timestamp),'%d-%b-%y %h:%m') `date`,count(msg) total  from chatter c , alumnireg a where (c.fromid=a.rowid or c.toid=a.rowid ) and (c.toid=$_SESSION[uid] or c.fromid=$_SESSION[uid]) and a.rowid !=$_SESSION[uid] group by rowid" ;
   //echo $sql;
    $db = new dbConnection();
    $con = $db->getConnection();
    //echo $sql;
    //Execute insert query
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Invalid query: ' . $sql);
    }
    ?>
<div class="list-group">
 <a href="#" class="list-group-item active">
  Conversations
  </a>

<?
if(mysqli_num_rows($result)==0){
       ?>
<a class="list-group-item">To Start the conversation, Please go to the user profile and click send message icon  </a></div>
           <?
            mysqli_close($con);
            return;
   }
    while($row = mysqli_fetch_array($result)) {
        ?><a class="list-group-item" href="chatter.php?refid=<?=$row["rowid"]?>" ><img src="<?=getProfilePic($row["rowid"])?>" width="32"> Conversation with <?=$row["fname"]?> <span class="badge"><?=$row["date"]?></span> <span class="label label-default"><?=$row["total"]?></span> </a> <?
    }
    ?></div><?
    mysqli_close($con);
}
function getThread($id){
    require_once('dbConnection.php');
    require_once('CommonMethod.php');
    $sql="SELECT *,date_format(timestamp,'%d/%b %h:%m') `date` FROM chatter where (toid = $_SESSION[uid] or fromid = $_SESSION[uid]) and (toid = $id or fromid = $id); ";
    $db = new dbConnection();
    $con = $db->getConnection();
    //echo $sql;
    //Execute insert query
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
?>
<div class="list-group">
 <a href="#" class="list-group-item active">
  Conversations
  </a>
    <?
    if(mysqli_num_rows($result)==0){
       ?>
    <a class="list-group-item">No Conversation Happened</a></div>
           <?
            mysqli_close($con);
            return;
   }
    while($row = mysqli_fetch_array($result)) {
        ?><a class="list-group-item" ><img src="<?=getProfilePic($row["toid"])?>" width="32"/><?=$row["msg"]?> <span class="badge glyphicon glyphicon-trash" onclick="DeleteChatter(<?=$row[id]?>)"> </span> <span class="badge"><?=$row["date"]?></span> </a><?
    }
    ?></div><?
    mysqli_close($con);
}
function deletemsg($id){
    $sql="delete from chatter where id=".$id;
    require_once('dbConnection.php');
    $db = new dbConnection();
    $con = $db->getConnection();
    //echo $sql;
    //Execute insert query
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
    mysqli_close($con);
   
}
function insertmsg($msg,$senderid){
    
    $sql="insert into chatter values(null,$_SESSION[uid],$senderid,'$msg',now() )";
    
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
    //$emailArray = array();
    $emailArray = getSenderEmail($senderid);
    $alink="http://ssnunite.com/activity/msg.php";
    sendinlinemail($_SESSION["uname"]." Sent Private Msg", $_SESSION["uname"]." sent a msg : $msg". " <br/> <a href='$alink'>Link Here</a>", $emailArray);
    
    mysqli_close($con);
   
}
function getSenderEmail($senderid){
     $sql = "select email from alumnireg where rowid=$senderid";
    //echo $sql;
    require_once('dbConnection.php');
    $db = new dbConnection();
    $con = $db->getConnection();
    //echo $sql;
    //Execute insert query
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
    $emailArray = array();
    while ($row = mysqli_fetch_array($result)) {
        $emailArray[]=$row['email'];
    }
    mysqli_close($con);
    return $emailArray;
}
?>
