<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

function insertPoll($question, $choice, $priority, $ownerid, $ownername) {
    $sql = "INSERT INTO `SimplePoll`
(`id`,
`Question`,
`Choices`,
`username`,
`userid`,
`role`,
`createdtime`)
VALUES
(
null,
'$question',
'$choice',
'$ownername',
'$ownerid',
'$priority',
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

    mysqli_close($con);
}

function answerPoll($id, $ans) {
    require_once('dbConnection.php');
    require_once('StringTokenizer.php');
    $db = new dbConnection();
    $con = $db->getConnection();

    $token = new StringTokenizer($ans, ",");
    $i = 0;
    while ($token->hasMoreTokens()) {
        $i++;
        if ($token->nextToken() == 0)
            continue;
        $sql = "UPDATE `SimplePoll` SET r$i=r$i+1 where id=$id";
        echo $sql;
        //Execute insert query
        $result = mysqli_query($con, $sql);
        $_SESSION["poll"] = "true";
        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
    }
    mysqli_close($con);
}

function resultPoll($id = 0) {
    require_once('dbConnection.php');
    require_once('StringTokenizer.php');
    $db = new dbConnection();
    $con = $db->getConnection();
    if ($id != 0)
        $sql = "select id,Question,Choices,r1+r2+r3+r4+r5+r6 sum,r1,r2,r3,r4,r5,r6 from SimplePoll where id=$id";
    else
        $sql = "select id,Question,Choices,r1+r2+r3+r4+r5+r6 sum,r1,r2,r3,r4,r5,r6 from SimplePoll where Active='true' order by id desc";
    //echo $sql;
    try {
        $result = mysqli_query($con, $sql);

        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
        $choice = "";
        $question = "";
        $id = "";
        if ($row = mysqli_fetch_array($result)) {

            $choices = $row['Choices'];
            $question = $row['Question'];
            $id = $row['id'];
            $sum = $row['sum'];
            $token = new StringTokenizer($choices, "#");
            $i = 0;
            ?>
            <ul class="nav nav-pills nav-stacked">
                <li><b><?= $question ?></b></li>
                <?
                while ($token->hasMoreTokens()) {
                    $i++;
                    ?>
                    <li><a><?= $token->nextToken() ?>
                            <? $vote = $row["r$i"]; ?>       
                            <div class="progress progress-striped">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?= ($vote * 100) / $sum ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= ($vote * 100) / $sum ?>%">
                                    <span class="sr-only"><?= ($vote * 100) / $sum ?>% Vote</span>
                                </div>
                            </div>
                        </a></li>
                    <?
                }
                ?></ul><?
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
        mysqli_close($con);
    }

    function togglepoll($id) {
        $sql = "update SimplePoll set Active =CASE WHEN Active = 'true' THEN 'false'
                             WHEN Active = 'false' THEN 'true' END where id=$id";
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

    function getAllpoll() {
        $sql = "select * from SimplePoll";
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
                    <th>Question</th>
                    <th>Active</th>
                    <th>Operation</th>
                    </thead>
                    <?
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?= $row["Question"] ?></td>
                            <td><a href="#" onclick="TogglePoll(<?= $row["id"] ?>)"><?= $row["Active"] ?></a></td>
                            <td> <a href="#" onclick="DeletePoll(<?= $row["id"] ?>)">Delete</a></td>
                        </tr>  
                        <?
        }
        ?></table></div></div><?
        mysqli_close($con);
    }
    function deletepoll($id) {
    $sql = "delete from SimplePoll where id=$id";
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

    ?>
