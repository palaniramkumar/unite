<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function insertStory($image,$msg){
    include './Activity.php';
    $sql="INSERT INTO `SSNClicks`
(`id`,
`image`,
`msg`,
`username`,
`userid`,
`role`,
`timestamp`)
VALUES
(
null,
'$image',
'$msg',
'$_SESSION[uname]',
'$_SESSION[uid]',
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
    $incrementid=  mysqli_insert_id($con);
    mysqli_close($con);    
    $msg=addActivities($msg,"imagestory",$incrementid);
    $emailArray = array();
    $emailArray = getGlobalusersByDept();
    $alink="";
    sendinlinemail($_SESSION["uname"]." Has Posted in SSN Stories", $msg, $emailArray);
    
}
function getGlobalusersByDept(){
     $sql = "select * from alumnireg a, alumnireg b where b.rowid=$_SESSION[uid] and b.branch=a.branch;";
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
function deleteStory($id){
    $sql="delete from SSNClicks where id='$id'";
    require_once('dbConnection.php');
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
function displayStory($filter,$userid=0,$page){
    $limit=20;
    $offset=$page*$limit;
    $sql="select id,image,msg,username,userid,date_format(timestamp,'%d/%m/%y %H:%i') from SSNClicks where userid='$userid'";
    
    if($filter =="Me"){
        $userid=$_SESSION["uid"];
        $sql="select id,image,msg,username,userid,date_format(timestamp,'%d/%m/%y %H:%i') from SSNClicks where userid='$userid'";
    }
    else if($userid==0 || $filter=='All'){
       $sql="select id,image,msg,username,userid,date_format(timestamp,'%d/%m/%y %H:%i') from SSNClicks";
    } 
    else{
        $sql="select id,image,msg,username,userid,date_format(timestamp,'%d/%m/%y %H:%i') from SSNClicks where role='$filter'";
    }
     $sql.=" order by id desc LIMIT $limit OFFSET $offset"; 
    require_once('dbConnection.php');
    $db = new dbConnection();
    $con = $db->getConnection();
    //echo $sql;
    //Execute insert query
    $result = mysqli_query($con, $sql);

    if (!$result) {
       die('Invalid query: ' . mysql_error());
    }
    if(mysqli_num_rows($result)==0){
       ?>
<li class=" well" style="margin-left: 15px ">No Record To Display</li>
           <?
            mysqli_close($con);
            return;
   }
   require_once('../class/HealthCheck.php');
    while($row = mysqli_fetch_array($result)){
    ?>
<div class="col-sm-6 col-md-3" >
        <div class="thumbnail panel" style="min-height: 350px">
            <img src="../class/timthumb.php?src=<?=  getHost()?>/uploads/college/<?=$row["image"]?>&w=216" style="min-height: 250px">
          <div class="caption">  
            <p><?=$row["msg"]?></p>
            <p><a href="#" class="btn btn-primary" onclick="deleteStory(<?=$row["id"]?>)"><?=($_SESSION["uid"]==$row["userid"]) || ($_SESSION["urole"]=="Admin")?Delete:""?></a> <a  href="viewclicks.php?img=<?=$row["image"]?>&msg=<?=$row["msg"]?>" class="btn btn-default">View</a></p>
          </div>
        </div>
      </div>
    <?}
    ?>

<ul class="pager">
                        <li class="next"><a onclick="ShowAllStories('<?=$filter?>',<?=$page+1?>);">More &rarr;</a></li>
                    </ul>   <?
    
    mysqli_close($con);
}
?>
