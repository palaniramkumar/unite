<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function insertEvent($title, $detail, $date, $time, $location, $food, $transport, $guest,$poll,$accommodation) {
    
    $sql = "INSERT INTO `event`
(`id`,
`title`,
`detail`,
`date`,
`time`,
`location`,
`food`,
`transport`,
`guest`,
`createdtime`,
`poll`,
`accommodation`)
VALUES
(
null,
'$title',
'$detail',
STR_TO_DATE('$date', '%m/%d/%Y'),
'$time',
'$location',
'$food',
'$transport',
'$guest',
now(),
'$poll',
$accommodation    
);
";
/*    echo $sql;
    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);*/
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
    $alink=  "http://ssnunite.com/event.php?id=".mysqli_insert_id($con);
    mysqli_close($con);
    addActivities($title,"event",$incrementid);
    $emailArray = array();
    $emailArray = getGlobalusers();

    sendinlinemail(strip_tags(html_entity_decode(stripslashes($title))). "! Event Created", $detail. " <br/> <a href='$alink'>Link Here</a>", $emailArray);
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

function saveEventAttendies($eventid, $food = 'none', $transport = 'none', $guest = 0,$poll='none',$accommodation='0',$mobile=0,$email="none") {

    $sql = "INSERT INTO `Event_Result`
(`id`,
`username`,
`userid`,
`guest`,
`food`,
`transport`,
`accommodation`,
`poll`,
`mobile`,
`email`,
`updatedtime`)
VALUES
(
'$eventid',
'$_SESSION[uname]',
'$_SESSION[uid]',
'$guest',
'$food',
'$transport',
'$accommodation',
'$poll',
'$mobile',
'$email',
 now()
);
";
    
    require_once('dbConnection.php');
    
    $db = new dbConnection();
    $con = $db->getConnection();
//echo $sql;
//Execute insert query
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Unable to Process your Request.Please Try Later: ' . mysql_error());
    }
    mysqli_close($con);
    echo "Thank you for registering. Please recommend your friends to register for Tribute";
}

function eventByID($id) {
    $sql = "SELECT e.id id,e.title title,e.detail detail,date_format(e.date,'%d-%m-%y') date,e.time time,
       e.location location,r.userid userid,e.food food,e.transport transport,e.guest guest,e.poll poll,e.accommodation accommodation
       FROM event e left join Event_Result r on e.id=r.id and r.userid= '" .$_SESSION["uid"] . "' where e.id=$id;";
    require_once('./class/dbConnection.php');
    $db = new dbConnection();
    $con = $db->getConnection();
    

    try {
        $result = mysqli_query($con, $sql);

        if (!$result) {
            die('Invalid query: ' . mysql_error() . $sql);
        } else if ($row = mysqli_fetch_array($result)) {

            $postid = $row['id'];
            $head = htmlspecialchars_decode($row['title']);
            $summary = htmlspecialchars_decode($row['detail']);
            $date = htmlspecialchars_decode($row['date']);
            $time =htmlspecialchars_decode( $row['time']);
            $location = htmlspecialchars_decode($row['location']);
            $attend=$row["userid"];
            $food=$row["food"];
            $transport=$row["transport"];
            $guest=$row["guest"];
            $poll = htmlspecialchars_decode($row['poll']);
            $accommodation=$row["accommodation"];
            
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
        <div class="row" style="padding-right: 50px">


            <div class="panel-body panel" >
                <div class="col-md-5">

                    <div class="well">
                        Event Date:  <?= $date ?> <?= $time ?>
                    </div>

                    <div class="well">
                        Event Location: <?= $location ?>
                    </div>
                    <?if($food==1){?>
                    <div class="well" id="misc">
                     <p> Misc: </p>
                      <?if($food==1 || $transport==1|| $guest==1){?>
                      <p><input type="radio" name="food" id="food" value="0">Veg | 
                      <input type="radio"  name="food" id="food" value="1">Non-Veg </p>
                      <?}if($transport==1){?>
                       <p><input type="checkbox" id="transport" value="yes"> Yes, I Need Transportation</p>
                       <?}if($guest==1){?>
                       <p>Total Number of Guests: <select id="guest">
                               <?for($i=0;$i<10;$i++){?>
                               <option value="<?=$i?>"><?=$i?></option>
                               <?}?>
                           </select></p>
                       <?}if($accommodation==1){?>
                       <p><input type="checkbox" id="accommodation" value="yes"> Yes, I Need an Accommodation</p>
                       <?}?>
                    </div>
                    <?}
                    if($poll!="" || $poll!=NULL){
                        require_once 'StringTokenizer.php';
                        $token=new StringTokenizer($row["poll"],",");
                        ?><div class="well" id="pollcollection">
                            <h4>I'm Interested In</h4><?
                        while($token->hasMoreTokens()){
                            $temp=$token->nextToken();
                            ?>
                            <input type="radio"  name ="poll" id="poll" value="<?=$temp?>"> <?=$temp?> <br/>
                            <?
                        }
                        ?></div><?
                    }
                    ?>
                    <div class="well">
                        Mobile: <input type="text" class="input-sm" placeholder="eg.987654321" id="mobile"/> <br/>
                        Email : <input type="text" class="input-sm" placeholder="eg,demo@ssn.com" id="email"/>
                    </div>    
                    <?if($_SESSION["uid"]!=NULL){?>
                    <button class="btn btn-info" data-loading-text="You have Registered." <?=$attend==NULL?"":"disabled"?> onclick="attendEvent()"> <?=$attend==NULL?"I Attend":"Already Registered"?></button>
                    <?}else{?>
                    <button class="btn btn-info" data-loading-text="You have Registered." disabled onclick="attendEvent()"> Login to Submit</button>
                    
                    <?}?>


                    <br/>

                    <div id="message"></div>

                </div>
                <div class="col-md-7 well">
                    <h2 class="featurette-heading"  ><?= $head ?></h2>
                    <p class="lead"><?= $summary ?></p>
                </div>
            </div>

        </div>
    </div><!--/span-->
    <?
}

function getAllEvent() {
    $sql = "select id,title,date_format(`date`,'%d-%m-%y') `date`,`time` from  `event`";
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
                <div class="panel-heading">Event Details</div>
                <div class="panel-body">
                    <p id="status"></p>
                </div>
                <table class="table">
                    <thead>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Attendee</th>
                    <th>Operation</th>
                    </thead>
                    <?
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?= htmlspecialchars_decode($row["title"]) ?></td>
                            <td><?= $row["date"] ?> <?= $row["time"] ?></td>
                            <td><a href="_event.php?action=exportuser&id=<?= $row["id"] ?>" >Download</a></td>
                            <td> <a href="#" onclick="DeleteEvent(<?= $row["id"] ?>)">Delete</a> | <a href="#" onclick="EditEvent(<?= $row["id"] ?>)">Edit</a> | <a href="../event.php?id=<?= $row["id"] ?>">View</a> </td>
                        </tr>  
                        <?
                    }
                    ?></table></div></div><?
        mysqli_close($con);
    }

    function deleteevent($id) {
        $sql = "DELETE FROM `event` WHERE id=$id ;";
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

    function  editevent($id) {
        $sql = "select id,title,detail,date_format(`date`,'%m/%d/%Y') date,time,location,food,transport,guest,poll,accommodation  FROM `event` WHERE id=$id ;";
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
        if ($row = mysqli_fetch_array($result)) {
            ?>
            <div class="col-md-4">

                <div class="well">
                    Event Date <input type="text" class="input-sm" placeholder="dd-mm-yyyy" value="<?= htmlspecialchars_decode($row["date"]) ?>"   id="date" >
                </div>
                <div class="well">
                    Event Time <input type="text" class="input-sm" placeholder="XX:YY" value="<?= htmlspecialchars_decode($row["time"]) ?>"  id="time" >
                </div>
                <div class="well">
                    Event Location <input type="text" class="input-sm " placeholder="Location" value="<?=htmlspecialchars_decode( $row["location"]) ?>" id="location" >
                </div>
                <div class="well">
                    Misc: <br/>
                    <input type="checkbox" <?= $row["food"] == 0 ? "" : "checked" ?>  id="food" value="Food">Food Type | 
                    <input type="checkbox" <?= $row["transport"] == 0 ? "" : "checked" ?> id="guest" value="guest">Guest | 
                    <input type="checkbox" <?= $row["guest"] == 0 ? "" : "checked" ?> id="transport" value="Transport">Transport |
                    <input type="checkbox" <?= $row["accommodation"] == 0 ? "" : "checked" ?> id="accommodation" value="accommodation">Need Accommodation 
                </div>

                <div class="well">
                                    Interested In: <br/>
                                    <input type="text" id="poll" class="input-sm" placeholder="Items Sperated by (,)" value="<?= htmlspecialchars_decode($row["poll"]) ?>"></div>


                <br/>

                <div id="message"></div>

            </div>
            <div class="col-md-7 well">
                <h2 class="featurette-heading editable" id='pHead'><?=htmlspecialchars_decode($row["title"])?></h2>
                <p class="lead editable" id="pSum" > <?=htmlspecialchars_decode($row["detail"])?> </p>

            </div>
            <input type='hidden' value="updateevent" id='type'/>
            <input type='hidden' value="<?= $row["id"] ?>" id='eventid'/>
            <?
        }
        mysqli_close($con);
    }

    function updateEvent($id, $title, $detail, $date, $time, $location, $food, $transport, $guest,$poll,$accommodation) {
        $sql = "UPDATE `event`
        SET

        `title` = '$title',
        `detail` = '$detail',
        `date` = STR_TO_DATE('$date', '%m/%d/%Y'),
        `time` = '$time',
        `location`='$location',
        `food` = '$food',
        `transport` = '$transport',
        `guest` = '$guest',
         `poll`='$poll',
         `accommodation`='$accommodation '    
        WHERE id=$id
        ";
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

    function downloadEventUsers($id) {
        
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment;filename=\"Event".$id.".csv\"");
        header("Cache-Control: max-age=0");
        
        $sql = "SELECT a.fname,guest,food,transport,accommodation,a.batch,mobile,e.email,poll,a.branch FROM Event_Result e, alumnireg a where a.rowid=e.userid and e.id=$id;";
        require_once('dbConnection.php');
        $db = new dbConnection();
        $con = $db->getConnection();
        //echo $sql;
        //Execute insert query
        $result = mysqli_query($con, $sql);

        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
        echo 'username,guest,food,transport,accommodation,branch,batch,number,email,poll'."\r\n";
        while ($row = mysqli_fetch_array($result)) {
            echo "$row[fname],$row[guest],$row[food],$row[transport],$row[accommodation],$row[branch],$row[batch],$row[mobile],$row[email],$row[poll]\n";
        }
        mysqli_close($con);
    }
    ?>
