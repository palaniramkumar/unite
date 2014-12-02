<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'CommonMethod.php';
session_start();
function getAllBuddies($filter){
    $id=$_SESSION["uid"];
    
    if($filter=="Dept"){
        $sql="select a.rowid,a.fname,a.batch,a.email,a.branch,date_format(a.dob,'%d,%b') dob,a.imgpath,a.org,a.desig from alumnireg a,alumnireg b where b.rowid=$id and a.branch=b.branch order by a.batch,a.fname";
    }
    else if($filter=="Class"){
        $sql="select a.rowid,a.fname,a.batch,a.email,a.branch,date_format(a.dob,'%d,%b') dob,a.imgpath,a.org,a.desig from alumnireg a,alumnireg b where b.rowid=$id and a.branch=b.branch and a.batch=b.batch order by a.fname";
    }
    else if($filter=="Student"){
        $sql="select a.rowid,a.fname,a.batch,a.email,a.branch,date_format(a.dob,'%d,%b') dob,a.imgpath,a.org,a.desig from alumnireg a,alumnireg b where b.rowid=$id and a.branch=b.branch and a.role='Student' order by a.fname";
    }
    else if($filter=="Faculty"){
        $sql="select a.rowid,a.fname,a.batch,a.email,a.branch,date_format(a.dob,'%d,%b') dob,a.imgpath,a.org,a.desig from alumnireg a,alumnireg b where b.rowid=$id and a.branch=b.branch and a.role='Faculty' order by a.fname";
    }
    
    require_once('dbConnection.php');
    $db = new dbConnection();
    $con = $db->getConnection();
    //echo $sql;
    //Execute insert query
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Invalid query: ' . mysql_error().$sql);
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
                    <th>Name</th>
                    <th>Birth Day</th>
                    <th>Department</th>
                    <th>Passed Out</th>
                    <th>Company</th>
                    <th>Actions</th>
                    </thead>
                    <?
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><img src="<?=  getProfilePic($row["rowid"])?>" width="48"/><a data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="<?=$row['email']?>, <?=$row['org']?> , <?=$row['desig']?>" data-original-title="" href="user.php?id=<?=$row["rowid"]?>"><?= htmlspecialchars_decode($row["fname"]) ?></a></td>
                            <td><?= $row["dob"] ?></td>
                            <td><?= $row["branch"] ?></td>
                            <td><?= $row["batch"] ?></td>
                            <td><a href="metasearch.php?org=<?= $row["org"]?>"><?= $row["org"]?></a></td>
                            <td><a href="#"  onclick="Spam('<?=$row["rowid"]?>','spam')">Spam</a> | <a href="#" onclick="Spam('<?=$row["rowid"]?>','nonclass')">Not In Our Class</a></td>
                            </tr>  
                        <?
                    }
                    ?></table></div></div><?
        mysqli_close($con);
    }

    
?>
