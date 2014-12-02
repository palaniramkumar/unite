<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function showPostHead($id) {
    $sql = "select * from post where id= " . $id . ";";
    require_once('./class/dbConnection.php');
    $db = new dbConnection();
    $con = $db->getConnection();
    $postid = "";
    $head = "";
    $summary = "";
    $desc = "";
    $tag = "";
    $ownername = "";
    $timestamp = "";
   
    try {
        $result = mysqli_query($con, $sql);

        if (!$result) {
            die('Invalid query: ' . mysql_error() . $sql);
        } 
	if(mysqli_num_rows($result )==0){
	    mysqli_close($con);
		header('Location: ' . '404.html', true, 301);
		return;
	}
	if ($row = mysqli_fetch_array($result)) {

		$head = strip_tags(htmlspecialchars_decode($row['Head']));
            $summary = strip_tags(htmlspecialchars_decode($row['Summary']));
            $tag = htmlspecialchars_decode($row['Tags']);
            $ownername = $row['ownername'];
            $timestamp = $row['createdtime'];
        }
	
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
    mysqli_close($con);
    ?>
<meta name="description" content="<?=$summary?>">
<meta name="keywords" content="<?=$tag?>">
    <meta name="author" content="<?=$ownername?>">
    <title><?=$head?></title>
        <?
}
function showPostbyID($id) {
    $sql = "select * from post where id= " . $id . ";";
    require_once('./class/dbConnection.php');
    $db = new dbConnection();
    $con = $db->getConnection();
    $postid = "";
    $head = "";
    $summary = "";
    $desc = "";
    $tag = "";
    $ownername = "";
    $timestamp = "";
    try {
        $result = mysqli_query($con, $sql);

        if (!$result) {
            die('Invalid query: ' . mysql_error() . $sql);
        } else if ($row = mysqli_fetch_array($result)) {

            $postid = $row['id'];
            $head = htmlspecialchars_decode($row['Head']);
            $summary = htmlspecialchars_decode($row['Summary']);
            $desc = htmlspecialchars_decode($row['Desc']);
            $tag = htmlspecialchars_decode($row['Tags']);
            $ownername = $row['ownername'];
            $timestamp = $row['createdtime'];
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
    mysqli_close($con);
    ?>
    <div class="col-xs-12 col-sm-9">
        <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
        </p>
        <div class="row">


            <div class="panel-body" >
                <div class="col-md-4" >
                    <img class="featurette-image img-responsive" <?=$row["Image"]=="null"|| $row["Image"]=="undefined" || $row["Image"]==""?  "src='./img/logo.png'" :"src=".getHost()."/class/timthumb.php?src=".getHost()."/uploads/post/$row[Image]&w=256"?>>

                </div>
                <div class="col-md-7 well">
                    <h2 class="featurette-heading" ><?= $head; ?></h2>
                    
                    <p class="lead"><?= $summary; ?></p>
                    
                </div>
            </div>

        </div>
        <p align="right" onclick="Spam('<?=$_REQUEST["id"]?>','post')"><a href="#">Report Spam?</a></p>
        <div class="panel panel-default">
            <div class="panel-body"><?= $desc; ?></div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <?if($_SESSION["uid"]!=NULL){?>
                <div class="col-lg-12">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-edit">Comment</span>
                        </span>
                        <input type="text" class="form-control" placeholder="Message" id="msg" >
                        <span class="input-group-btn">
                            <button class="btn btn-default"  data-loading-text="Loading..." type="button" onclick="addcomment()">Post!</button>
                        </span>
                    </div><!-- /input-group -->
                </div>
                <?}
                else{
                    echo "Please Login to make a comment...";
                }
?>

            </div>
        </div> 
        <div id="commentdiv">
            Loading...
        </div>

    </div><!--/span-->
    <?
}

function insertPost($head, $summary, $desc, $tags, $imagepath, $priority, $ownerid, $ownername) {

  
    $sql = "INSERT INTO `post`
(`id`,
`Head`,
`Summary`,
`Desc`,
`Tags`,
`Image`,
`Priority`,
`ownerid`,
`ownername`,
`createdtime`)
VALUES
(
null,
'$head',
'$summary',
'$desc',
'$tags',
'$imagepath',
'$priority',
'$ownerid',
'$ownername',
now()
);";
    echo $sql;
    require_once('dbConnection.php');
    require_once('sendmail.php');
    require_once ('Activity.php');
    $db = new dbConnection();
    $con = $db->getConnection();
    //echo $sql;
    //Execute insert query
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
    $incrementid=  mysqli_insert_id($con);
    $alink=  "http://ssnunite.com/page.php?id=".$incrementid;
    mysqli_close($con);
    
    addActivities($head,"post",$incrementid);
    $emailArray = array();
    $emailArray = getGlobalusers();
    sendinlinemail(strip_tags(html_entity_decode(stripslashes($head))). "! Page Created", $summary. " <br/> <a href='$alink'>Link Here</a>", $emailArray);
    
}
function getGlobalusers(){
     $sql = "select email from alumnireg where role in('Alumni','Admin','Student','Faculty')";
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
function insertComment($eventid, $comment, $role, $ownerid, $ownername) {
    $sql = "INSERT INTO `post_comments`
(`id`,
`event_id`,
`comment`,
`userid`,
`username`,
`userrole`,
`timestamp`)
VALUES
(
null,
'$eventid',
'$comment',
'$ownerid',
'$ownername',
'$role',
now()
);
";
    echo $sql;
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

function deleteComment($id, $role, $ownerid) {
    $sql = "DELETE FROM `post_comments` WHERE id=$id and userid='$ownerid' ;";
    if($role=="Admin")
            $sql = "DELETE FROM `post_comments` WHERE id=$id  ;";
    //echo $sql;
    require('dbConnection.php');
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

function getComment($eventid) {
    
    require_once   '../class/CommonMethod.php';
    $sql = "select id,username,userid,comment,date_format(timestamp,'%d/%m/%y %H:%i') timestamp FROM `post_comments` WHERE event_id=$eventid ";
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
    if(mysqli_num_rows($result)==0){
       ?>
    <div class="panel panel-default">
            <div class="panel-body">
    You are the first person to comment on this page
            </div>
    </div>
           <?
            mysqli_close($con);
            return;
   }
    while ($row = mysqli_fetch_array($result)) {
      
        ?>
        <div class="panel panel-default">
            <div class="panel-body">

                <ul class="media-list">
                    <li class="media">
                        <a class="pull-left" href="./activity/user.php?id=<?=$row[userid]?>">
                            <img class="media-object" width="48" src="<?=getProfilePic($row[userid])?>">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?= $row["username"] ?></h4>
                            <p><?= $row["comment"] ?></p>


                            <p style="text-align: right">

                                <span><?= $row["timestamp"] ?></span>
                            </p>

                        </div>


                    </li>
                </ul>

            </div>

        </div>
        <? if ($_SESSION["uid"] == $row["userid"] || $_SESSION["urole"] =="Admin") { ?>
            <p style="text-align: right"><a href="#" onclick="deletecomment('<?= $row["id"] ?>')">Delete</a></p>

        <?
        }
    }
    mysqli_close($con);
}

function getallpost($ownerid="none",$filter="Me",$source="editor") {
    if($filter=="Me")
        $sql = "select id,Head,date_format(createdtime,'%d/%m/%y') createdtime,HomePage,ownername from  `post` WHERE ownerid=$ownerid ;";
    else if($filter=="All")
        $sql = "select id,Head,date_format(createdtime,'%d/%m/%y') createdtime,HomePage,ownername from  `post` ";
    else
        $sql = "select id,Head,date_format(createdtime,'%d/%m/%y') createdtime,HomePage,ownername from  `post` WHERE Priority='$filter' ;";
    
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
    ?>
    <div class="panel">
        <div class="panel-body">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">Post Details</div>
                <div class="panel-body">
                    <p id="status"></p>
                </div>
                <table class="table">
                    <thead>
                    <th>Heading</th>
                    <th>Date</th>
                    <?if($_SESSION["urole"]=="Admin"){?>
                    <th>Home Page</th>
			 <th>Created By</th>
			<?}?>          
                    <th>Operation</th>
                    </thead>
                    <?
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?= htmlspecialchars_decode($row["Head"]) ?></td>
                            <td><?= $row["createdtime"] ?></td>
                            <?if($_SESSION["urole"]=="Admin"){?><td><a href="#" onclick="TogglePost(<?= $row["id"] ?>)"><?= $row["HomePage"] == 0 ? "No" : "Yes" ?></a></td><td><?= $row["ownername"] ?></td><?}?>
                            <td><?if($source!="viewer"){?> <a href="#" onclick="DeletePost(<?= $row["id"] ?>)">Delete</a> | <a href="#" onclick="EditPost(<?= $row["id"] ?>)">Edit</a> |<?}?> <a href="../page.php?id=<?= $row["id"] ?>" >View</a></td>
                        </tr>  
                        <?
                    }
                    ?></table></div></div><?
        mysqli_close($con);
    }

    function deletepost($id) {
        $sql = "DELETE FROM `post` WHERE id=$id ;";
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

        mysqli_close($con);
    }

    function togglepost($id) {
        $sql = "update `post` set HomePage=(HomePage+1)%2 WHERE id=$id ;";
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

        mysqli_close($con);
    }

    function editpost($id) {
        $sql = "select * from post where id= " . $id . ";";
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
        if($row = mysqli_fetch_array($result)){
        ?>
        <div class="row" >


            <div class="panel-body" >
                <div class="col-md-4" >
                    <img style="margin: auto" id="imgpreview" class="featurette-image img-responsive"  src=<?= ($row["Image"]=="" || $row["Image"]=="null" || $row["Image"]==NULL)?"../img/logo.png":"../uploads/post/$row[Image]"?> alt="">

                    <form id="myForm" action="../class/upload.php" method="post" enctype="multipart/form-data">
                        <p><input type="file" size="60" name="myfile" value=""   id="filepic"></p>
                        <input type="hidden" value="<?=$row["Image"]?>" id="filepichidden"/>
                        <input type="hidden" value="post" name="imagetype"/>
                       <p style="text-align: center"><input type="submit"  value="Upload"></p>

                    </form>


                    <br/>

                    

                </div>
                <div class="col-md-7 well">
                    <h2 class="featurette-heading editable" id='pHead'><?= htmlspecialchars_decode($row["Head"]) ?></h2>
                    <p class="lead editable" id="pSum"><?= htmlspecialchars_decode($row["Summary"]) ?></p>
                    <p class="editable panel" id="pTag"><?=htmlspecialchars_decode($row["Tags"])?></p>
                    <div id="progress">
                                        <div id="bar"></div>
                                        <div id="percent">0%</div >
                                    </div>
                                 <div id="message"></div>
                    <input type='hidden' value="updatepost" id='type'/>
                    <input type='hidden' value="<?= $row["id"] ?>" id='postid'/>
                    
                </div>

            </div>

        </div>
        <div class="panel panel-default editable">
            <div class="panel-body" id="pDesc"><?= $row["Desc"] ?></div>
        </div>
        <?
        }
        mysqli_close($con);
    }

    function updatepost($id, $head, $summary, $desc, $tags, $imagepath) {
        $sql = "update `post` set Head='$head' , Summary='$summary' , `Desc`='$desc' , Tags='$tags' , Image='$imagepath'  WHERE id=$id ;";
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

        mysqli_close($con);
    }
    ?>
