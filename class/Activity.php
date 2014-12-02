<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once  ('../class/CommonMethod.php');

function showtweetasgrid($filter,$type,$page=0){
    $limit=24;
    $offset=$page*$limit;
    $sql="select id,msg,username,userid,date_format(timestamp,'%d/%m/%y %H:%i'),role from Tweets where type='$type' and role='$filter' ";
    
    if($filter =="Me"){
        $userid=$_SESSION["uid"];
        $sql="select id,msg,username,userid,date_format(timestamp,'%d/%m/%y %H:%i'),role from Tweets where userid='$userid' and type='$type'";
    }
    else if($userid==0 || $filter=='All'){
       $sql="select id,msg,username,userid,date_format(timestamp,'%d/%m/%y %H:%i'),role from Tweets where  type='$type'";
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
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail panel">
            
            <ul class="media-list">
            <li class="media">
              <a class="pull-left" href="user.php?id=<?=$row["userid"]?>">
                <img class="media-object" width="32px" src="<?=getProfilePic($row[userid],32)?>" >
              </a>
              <div class="media-body">
                  <h4 class="media-heading"><small> <a class="pull-left " href="user.php?id=<?=$row["userid"]?>"><?=$row["username"]?></a></small></h4><br/>
                <p><?=$row["msg"]?></p>
                <p><a href="#" class="btn btn-primary btn-xs" onclick="deleteStory(<?=$row["id"]?>)"><?=($_SESSION["uid"]==$row["userid"]) || ($_SESSION["urole"]=="Admin")?"<span class='glyphicon glyphicon-remove'></span>":""?></a> <a  href="singleactivity.php?id=msg=<?=$row["id"]?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></a></p>
              </div>
            </li>
          </ul>
            
        
        </div>
      </div>

    <?}
    ?>
          <ul class="pager">
                    
                    <li class="next"><a href="#" onclick="loadtweet('<?=$type?>',<?=$page+1?>);">More &rarr;</a></li>
                </ul>  
        <?
    mysqli_close($con);

}

function showtweet($type='all',$page=0){
    $limit=10;
    $offset=$page*$limit;
    if(strcasecmp($type,'all')==0)
        $sql="SELECT t.id tweetid,t.msg tweetmsg,t.username tweetuser,t.userid tweetuid,date_format(t.timestamp,'%d/%m %m:%i') tweettime,   r.id commentid,r.msg commentmsg,r.username commentuser,r.userid commentuid,date_format(r.timestamp,'%d/%m %m:%i')  commenttime FROM Tweets t left join Tweet_Reply r on t.id=r.tweetid  order by t.id desc";
    else if(strcasecmp($type,'me')==0)
        $sql="SELECT t.id tweetid,t.msg tweetmsg,t.username tweetuser,t.userid tweetuid,date_format(t.timestamp,'%d/%m %m:%i') tweettime,   r.id commentid,r.msg commentmsg,r.username commentuser,r.userid commentuid,date_format(r.timestamp,'%d/%m %m:%i')  commenttime FROM Tweets t left join Tweet_Reply r on t.id=r.tweetid  where t.userid='$_SESSION[uid]' order by t.id desc";
    else 
        $sql="SELECT t.id tweetid,t.msg tweetmsg,t.username tweetuser,t.userid tweetuid,date_format(t.timestamp,'%d/%m %m:%i') tweettime,   r.id commentid,r.msg commentmsg,r.username commentuser,r.userid commentuid,date_format(r.timestamp,'%d/%m %m:%i')  commenttime FROM Tweets t left join Tweet_Reply r on t.id=r.tweetid  where t.role='$type' order by t.id desc";
   
    $sql.=" LIMIT $limit OFFSET $offset";        
    require_once('dbConnection.php');
    $db = new dbConnection();
    $con = $db->getConnection();
    //echo $sql;
    //Execute insert query
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Invalid query: ' .  mysqli_error($con));
    }
    $previd=0;
    while($row = mysqli_fetch_array($result)) {
        if($previd!=$row["tweetid"] && $previd!=0){?>
      </div>
            

              
          </div>
      
   
  </li>
      <?
    
      } 
        if($previd!=$row["tweetid"]){
           
    ?>
    <li class="media well" id='tweet<?=$row["tweetid"]?>'>
    <a class="pull-left " href="user.php?id=<?=$row["tweetuid"]?>">
      <img class="media-object" height="64" src="<?=getProfilePic($row["tweetuid"])?>"  alt="Generic placeholder image">
    </a>
    <div class="media-body">
      
     <h4 class="media-heading"><h4><a href="user.php?id=<?=$row["tweetuid"]?>"><?=$row["tweetuser"]?></a></h4>
         <p><?=  htmlspecialchars_decode($row["tweetmsg"])?></p>
       <p style="text-align: right"><a href='#' onclick='deletetweet(<?=$row["tweetid"]?>)'><?=($row["tweetuid"]==$_SESSION["uid"])?"Delete":""?></a> | <?=$row["tweettime"]?> </p>
     
      <div class="input-group" style="margin-bottom: 10px">
      <input type="text" class="form-control" id='comment<?=$row["tweetid"]?>'>
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" onclick='tweetcomment(<?=$row["tweetid"]?>)'>Comment!</button>
      </span>
    </div>
      <div id='nested<?=$row["tweetid"]?>'>
      
        <?}if($row["commentid"]!=null){
         ?>
          <div class="media" id='comment<?=$row["commentid"]?>'>
          <a class="pull-left" href="user.php?id=<?=$row["commentuid"]?>">
      <img class="media-object" height="64" src="<?=getProfilePic($row["commentuid"])?>">
    </a>
    <div class="media-body">
       <h4 class="media-heading"><?=$row["commentuser"]?></h4>
      
      <p><?=$row["commentmsg"]?></p>
      <p style="text-align: right"><a href='#' onclick='deletecomment(<?=$row["commentid"]?>)'><?=($row["commentuid"]==$_SESSION["uid"])?"Delete":""?></a> | <?=$row["commenttime"]?> </p>
    </div></div>
         <? 
      }
      
     $previd=$row["tweetid"];
     
    }
    ?> </div>
            

              
          </div>
      
   
  </li>
      <div class="list-group loadmore">
          <a href="#comment<?=$row["tweetid"]?>" class="list-group-item" onclick="loadtweet('<?=$type?>',<?=$page+1?>);"><center><b>Load More</b></center></a>
      </div>
      <?
   if(mysqli_num_rows($result)==0){
       ?>
  <li class="media well">No Record To Display</li>
           <?
   }
    mysqli_close($con);
}
function showsingletweet($id){

    $sql="SELECT t.id tweetid,t.msg tweetmsg,t.username tweetuser,t.userid tweetuid,date_format(t.timestamp,'%d/%m %m:%i') tweettime,   r.id commentid,r.msg commentmsg,r.username commentuser,r.userid commentuid,date_format(r.timestamp,'%d/%m %m:%i')  commenttime FROM Tweets t left join Tweet_Reply r on t.id=r.tweetid  where t.id=$id order by t.id desc";
   
            
    require_once('dbConnection.php');
    $db = new dbConnection();
    $con = $db->getConnection();
    //echo $sql;
    //Execute insert query
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Invalid query: ' .  mysqli_error($con));
    }
    $previd=0;
    if(mysqli_num_rows($result)==0){
       ?>
  <li class="media well">No Record To Display</li>
           <?
   }
    while($row = mysqli_fetch_array($result)) {
        if($previd!=$row["tweetid"] && $previd!=0){?>
      </div>
            

              
          </div>
      
   
  </li>
      <?
    
      } 
        if($previd!=$row["tweetid"]){
           
    ?>
    <li class="media well" id='tweet<?=$row["tweetid"]?>'>
    <a class="pull-left " href="user.php?id=<?=$row["tweetuid"]?>">
      <img class="media-object" height="64" src="<?=getProfilePic($row["tweetuid"])?>"  alt="Generic placeholder image">
    </a>
    <div class="media-body">
      
     <h4 class="media-heading"><h4><?=$row["tweetuser"]?></h4>
      <p><?=$row["tweetmsg"]?></p>
       <p style="text-align: right"><a href='#' onclick='deletetweet(<?=$row["tweetid"]?>)'><?=($row["tweetuid"]==$_SESSION["uid"])?"Delete":""?></a> | <?=$row["tweettime"]?> </p>
     
      <div class="input-group" style="margin-bottom: 10px">
      <input type="text" class="form-control" id='comment<?=$row["tweetid"]?>'>
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" onclick='tweetcomment(<?=$row["tweetid"]?>)'>Comment!</button>
      </span>
    </div>
      <div id='nested<?=$row["tweetid"]?>'>
      
        <?}if($row["commentid"]!=null){
         ?>
          <div class="media" id='comment<?=$row["commentid"]?>'>
          <a class="pull-left" href="user.php?id=<?=$row["commentuid"]?>"">
      <img class="media-object" height="64" src="<?=getProfilePic($row["commentuid"])?>">
    </a>
    <div class="media-body">
       <h4 class="media-heading"><?=$row["commentuser"]?></h4>
      
      <p><?=$row["commentmsg"]?></p>
      <p style="text-align: right"><a href='#' onclick='deletecomment(<?=$row["commentid"]?>)'><?=($row["commentuid"]==$_SESSION["uid"])?"Delete":""?></a> | <?=$row["commenttime"]?> </p>
    </div></div>
         <? 
      }
      
     $previd=$row["tweetid"];
     
    }
    ?> </div>
            

              
          </div>
      
   
  </li><?
   
    mysqli_close($con);
}


function addTweet($msg,$type='activity') {
    $sql = "INSERT INTO `Tweets`
            
            VALUES
            (
            null,
            '$msg',
            NULL,
            '$_SESSION[uname]',
            '$_SESSION[uid]',
            '$_SESSION[urole]',
            now(),
            '$type'
            );
            ";
    //echo $sql;
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
    if($type=="video"){
        mysqli_close($con);
        return;
    }
    ?>
        <li class="media well">
    <a class="pull-left " href="#">
      <img class="media-object" height="64" src="<?=getProfilePic($_SESSION[uid])?>">
    </a>
    <div class="media-body">
      <h4 class="media-heading"><?=$_SESSION["uname"]?></h4>
      <p><?=$msg?></p>
      <div class="input-group" style="margin-bottom: 10px">
      <input type="text" class="form-control" id='comment<?=$incrementid?>'>
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" onclick='tweetcomment(<?=$incrementid?>)'>Comment!</button>
      </span>
    </div>
      <div id='nested<?=$incrementid?>'></div>
            

              
          </div>
      
   
  </li><?
    mysqli_close($con);
}
function addActivities($msg,$type,$incrementid) {
    
    if($type=="imagestory")
        $msg="Uploaded the story <a href='viewclicks.php?id=$incrementid'>".$msg."</a> ";
    if($type=="event")
        $msg="Created the Event <a href='../event.php?id=$incrementid'>".$msg."</a> ";
    if($type=="post")
        $msg="Created the Post <a href='../page.php?id=$incrementid'>".$msg."</a> ";
    $msg=  mysql_escape_string($msg);
    //echo $msg;
    $sql = "INSERT INTO `Tweets`
            
            VALUES
            (
            null,
            '$msg',
            NULL,
            '$_SESSION[uname]',
            '$_SESSION[uid]',
            '$_SESSION[urole]',
            now(),'activity'
            );
            ";
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
    
    mysqli_close($con);
    return $msg;
}

function addActivityComment($tweetid,$msg) {
    $sql="INSERT INTO `Tweet_Reply`
(`id`,
`msg`,
`tweetid`,
`username`,
`userid`,
`role`,
`timestamp`)
VALUES
(
null,
'$msg',
'$tweetid',
'$_SESSION[uname]',
'$_SESSION[uid]',
'$_SESSION[urole]',
now()
);
";
    require_once('dbConnection.php');
    require_once('sendmail.php');

    $db = new dbConnection();
    $con = $db->getConnection();
    //echo $sql;
    //Execute insert query
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
    ?>
  <a class="pull-left" href="#">
      <img class="media-object" height="64" src="<?=getProfilePic($_SESSION[uid])?>">
    </a>
    <div class="media-body">
      <h4 class="media-heading"><?=$_SESSION["uname"]?></h4>
      <p><?=$msg?></p>
      
    </div>
        <?
    mysqli_close($con);
    $msg="$_SESSION[uname] Commented on Tweet#$tweetid as '$msg'. Please click <a href='http://ssnunite.com/activity/singleactivity.php?id=$tweetid'>here</a> to follow-up";
    $emailArray = array();
    $emailArray = getcommentedusers($tweetid);
    
    sendinlinemail( "$_SESSION[uname] Commented on Tweet", $msg, $emailArray);

}
function getcommentedusers($tweetid){
     $sql = "SELECT a.email email FROM Tweets t  join Tweet_Reply r on t.id=r.tweetid , alumnireg a where tweetid =$tweetid and a.rowid=r.userid  group by r.userid";
    //echo $sql;
    require_once('dbConnection.php');
    $db = new dbConnection();
    $con = $db->getConnection();
    //echo $sql;
    //Execute insert query
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Invalid query: ' .$sql);
    }
    $emailArray = array();
    while ($row = mysqli_fetch_array($result)) {
        $emailArray[]=$row['email'];
    }
    mysqli_close($con);
    return $emailArray;
}

function deleteTweet($id) {
     $sql = "delete from Tweets where id=$id and userid='$_SESSION[uid]'";
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


function deleteActivityComment($id) {
    
 $sql = "delete from Tweet_Reply where id=$id and userid='$_SESSION[uid]'";
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

function editTweet() {
    
}

function editComment() {
    
}

?>
