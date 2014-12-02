<?php
session_start();
function addSiteUpdate($msg, $url) {
    $sql = "INSERT INTO `siteupdates`
(`id`,
`item`,
`url`,
`ownerid`,
`ownername`,
`priority`,
`timestamp`)
VALUES
(
null,
'$msg',
'$url',
'$_SESSION[uid]',
'$_SESSION[uname]',
'$_SESSION[urole]',
now()
);
";
    require_once('dbConnection.php');
    $db = new dbConnection();
    $con = $db->getConnection();
    echo $sql;
    //Execute insert query
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
    echo 'inserted';
    mysqli_close($con);
}
function getUpdates(){
    $sql="SELECT * FROM siteupdates  where `timestamp` > DATE_SUB(now(),INTERVAL 1 year ) ";
    require_once('dbConnection.php');
    $db = new dbConnection();
    $con = $db->getConnection();
    //echo $sql;
    //Execute insert query
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }

    while($row = mysqli_fetch_array($result)){
        ?>
<tr>
<td><?=$row["item"]?></td>
<td><?=$row["url"]?></td>
<td><?=$row["timestamp"]?></td>
<td><div class="btn-group">
  <button type="button" class="btn btn-default" onclick="deleteupdate(<?=$row["id"]?>)"><span class="glyphicon glyphicon-remove"></span></button>
  </div>
</div></td></tr>
            <?
    }

    

    mysqli_close($con);
}
function trashUpdate(){
    $sql="delete  FROM siteupdates  where `timestamp` < DATE_SUB(now(),INTERVAL 1 year )";
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
    echo "deleted";
}
function deleteUpdate($id){
    $sql="delete  FROM siteupdates  where id=$id";
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
    echo "deleted";
}
if($_REQUEST["action"]=="insert"){
    $msg=htmlspecialchars(mysql_escape_string($_REQUEST["msg"]));
    $url=htmlspecialchars(mysql_escape_string($_REQUEST["url"]));

    addSiteUpdate($msg, $url);
    echo 'inserted';
}
if($_REQUEST["action"]=="select"){
    getUpdates();
    echo 'loaded';
}
if($_REQUEST["action"]=="trash"){
    trashUpdate();
    echo 'trash';
}
if($_REQUEST["action"]=="delete"){
    deleteUpdate($_REQUEST["id"]);
    echo 'trash';
}
?>
