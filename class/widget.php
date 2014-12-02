<?
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('dbConnection.php');
session_start();

function homePagePost() {
    $sql = "select * from post where homepage=1 order by id desc limit 5;";
    $db = new dbConnection();
    $con = $db->getConnection();

    try {
        $result = mysqli_query($con, $sql);

        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
        if (mysqli_num_rows($result) == 0) {
            ?>
            <a class="list-group-item">No Updates...</a>
            <?
            mysqli_close($con);
            return;
        }
        while ($row = mysqli_fetch_array($result)) {
            ?>
            

                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class='glyphicon glyphicon-pushpin'></span> <?= htmlspecialchars_decode($row["Head"]) ?></h3>
                    </div>
                    <div class="panel-body" style="padding: 15px;text-align: justify;min-height: 160px">
                        <div class="list-group">
                            <?if(strpos($row['Image'],'.png') !== false || strpos($row['Image'],'.jpg') !== false){?>
                            <img src='<?=  getHost()?>/class/timthumb.php?src=<?= getHost()?>/uploads/post/<?=$row['Image']?>&w=216&h=128'/>
                            <?}?>
                            <div style="min-height: 140px">
                            <?= htmlspecialchars_decode(substr($row["Summary"], 0, 216)) ?>...
                            </div>
                            <p><a class="btn btn-default" href="page.php?id=<?= $row["id"] ?>">View details &raquo;</a></p>
                        </div>
                    </div>
                </div>

                
           
            <?
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
    mysqli_close($con);
}

function upcomingEvent() {
    $sql = "select id,title,DATE_FORMAT(date,'%d-%m-%y') date from event where `date` >= date(now());";

    $db = new dbConnection();
    $con = $db->getConnection();


    try {
        $result = mysqli_query($con, $sql);

        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
        if (mysqli_num_rows($result) == 0) {
            ?>
            <a class="list-group-item">No Events Scheduled...</a>
            <?
            mysqli_close($con);
            return;
        }
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <a href="event.php?id=<?= $row['id'] ?>" class="list-group-item"><?= $row['title'] ?><span class="badge"><?= $row['date'] ?></span></a>
            <?
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
    mysqli_close($con);
}

function latestPoll($id = 0) {

    require_once('StringTokenizer.php');

    $sql = "";
    if ($id == 0)
        $sql = "select Question,Choices,id from SimplePoll where Active='true' order by id desc";
    else
        $sql = "select Question,Choices,id from SimplePoll where Active='true' and id=$id";

    $db = new dbConnection();
    $con = $db->getConnection();
    try {
        $result = mysqli_query($con, $sql);

        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
        $choices = "";
        $question = "";
        if (mysqli_num_rows($result) == 0) {
            ?>
            <a class="list-group-item">No Updates...</a>
            <?
            mysqli_close($con);
            return;
        }
        if ($row = mysqli_fetch_array($result)) {

            $choices = $row['Choices'];
            $question = $row['Question'];
            $id = $row['id'];
        }
        ?>
        <ul class="nav nav-pills nav-stacked">
            <li><b><?= $question ?></b></li>
            <?
            /* Use tab and newline as tokenizing characters as well  
              $tok = strtok($choice, "#");
              $i=0;
              while ($tok !== false) {
              $i++;

              ?>

              <?
              echo "$tok<br />";
              $tok = strtok("#");
              } */

            $token = new StringTokenizer($choices, "#");
            while ($token->hasMoreTokens()) {
                $i++;
                ?><li><a><input type="radio" name="votepoll" id="r<?= $i ?>" > <?= $token->nextToken() ?></a></li>
                        <?
                    }
                    ?></ul><button class="btn btn-info" data-loading-text="Loading..." onclick="submitPoll(<?= $id ?>)">Vote</button>

        <?
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
    mysqli_close($con);
}

function getUpdates() {
    $sql = "SELECT * FROM siteupdates  where `timestamp` > DATE_SUB(now(),INTERVAL 1 year ) order by timestamp desc";
    require_once('dbConnection.php');
    $db = new dbConnection();
    $con = $db->getConnection();
    //echo $sql;
    //Execute insert query
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
    if (mysqli_num_rows($result) == 0) {
        ?>
        <a class="list-group-item">No Updates...</a>
        <?
        mysqli_close($con);
        return;
    }
    while ($row = mysqli_fetch_array($result)) {
        ?>
        <a class="list-group-item" href="http://<?= $row["url"] ?>" target="_blank"><?= $row["item"] ?></a>
        <?
    }



    mysqli_close($con);
}

function upcomingBirthday() {
    $sql = "select fname,rowid,date_format(dob,'%d-%b') `date` from alumnireg where month(dob)=month(now()) and day(dob)>=day(now()) order by `date`";
    require_once('dbConnection.php');
    $db = new dbConnection();
    $con = $db->getConnection();
    //echo $sql;
    //Execute insert query
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
    $bool = "0";
    while ($row = mysqli_fetch_array($result)) {
        $bool = 1;
        ?>
        <a class="list-group-item" href="user.php?id=<?= $row["rowid"] ?>"><?= ucfirst($row["fname"]) ?><span class="badge"><?= $row['date'] ?></span></a>
        <?
    }
    if ($bool == 0)
        echo "<a class='list-group-item'>No one born on this month</a>";


    mysqli_close($con);
}
?>
