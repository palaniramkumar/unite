<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function ExportAllValidUser($branch,$batch,$verified="all",$filter="restricted",$date) {

        
    if($filter=="all" && $date!="")
        $substr=" where regdate >'".$date."'";
    else if($date != "")
        $substr = " and regdate >'".$date."'";
    
    if($verified=="all")
        $sql = "select rowid,fname,email,role,branch,batch,verified from alumnireg where branch='$branch' and batch='$batch' $substr order by role,batch,branch,fname ";
    else
        $sql = "select rowid,fname,email,role,branch,batch,verified from alumnireg where branch='$branch' and batch='$batch' and verified=$verified $substr order by role,batch,branch,fname ";
    if($filter=="all")
        $sql="select rowid,fname,email,role,branch,batch,verified from alumnireg ".$substr;
    require_once('dbConnection.php');
    require_once('HealthCheck.php');

    $db = new dbConnection();
    $con = $db->getConnection();

    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Alumni_Details.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);

    echo "<table>";
    $num_rows = mysqli_num_rows($result);
    if($num_rows==0) echo "No Record Found!";
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr class="<?=$row["role"]?> record">  
            <td> <?=$row["fname"]?></td>  
            <td><?=$row["branch"]?></td><td> <?=$row["batch"]?> </td>  
            
            <td><?=$row["email"]?></td>
            <td><?=$row["role"]?></td>
            <td>
                
                <?if($row["verified"]==1){
                    ?> <td><?="Verified"?></td>
</button><?
            } else{?>
                 <td><?="Not Verified"?></td>
                    <?
            }
?></td>
            
            <td><?=$row["rowid"]?>
            </td>
          </tr> 
  
                        <?}
    mysqli_close($con);
    echo "</table>";
}

function getAllValidUser($branch,$batch,$verified="all",$filter="restricted",$date) {
     
    if($filter=="all" && $date!="")
        $substr=" where regdate >'".$date."'";
    else if($date != "")
        $substr = " and regdate >'".$date."'";
    
    if($verified=="all")
        $sql = "select rowid,fname,email,role,branch,batch,verified,org,desig,country,skill from alumnireg where branch='$branch' and batch='$batch' $substr order by role,batch,branch,fname ";
    else
        $sql = "select rowid,fname,email,role,branch,batch,verified,org,desig,country,skill from alumnireg where branch='$branch' and batch='$batch' and verified=$verified $substr order by role,batch,branch,fname ";
    if($filter=="all")
        $sql="select rowid,fname,email,role,branch,batch,verified,org,desig,country,skill from alumnireg ".$substr;
    require_once('dbConnection.php');
    require_once('HealthCheck.php');

    $db = new dbConnection();
    $con = $db->getConnection();

    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
    $num_rows = mysqli_num_rows($result);
    if($num_rows==0) echo "No Record Found!";
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr class="<?=$row["role"]?> record">  
            <td><a data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="<?=$row['email']?>, <?=$row['org']?> , <?=$row['desig']?>, <?=$row['skill']?>" data-original-title="" href="../Activity/user.php?id=<?=$row["rowid"]?>"> <?=$row["fname"]?></a></td>  
            <td><?=$row["branch"]?> [<?=$row["batch"]?>] </td>  
            
            <td><?=$row["email"]?></td>
            <td><?=$row["role"]?></td>
            <td>
                
                <?if($row["verified"]==1){
                ?> <button type="button" class="btn btn-default btn-xs" onclick="setverification('0',<?=$row["rowid"]?>)">
                    <span class="glyphicon glyphicon-ok" title="Verified"></span> 
</button><?
            } else{?>
                 <button type="button" class="btn btn-default btn-xs" onclick="setverification('1',<?=$row["rowid"]?>)">
  <span class="glyphicon glyphicon-pause" title="Not Verified"></span> 
</button>
                    <?
            }
?></td>
            
            <td><div class="btn-group"><button type="button" title="Block" class="btn btn-default btn-xs" onclick="setrole('Block',<?=$row["rowid"]?>)">
  <span class="glyphicon glyphicon-ban-circle" ></span> 
</button>
            <button type="button" class="btn btn-default btn-xs" title="Admin" onclick="setrole('Admin',<?=$row["rowid"]?>)">
  <span class="glyphicon glyphicon-tower"></span> 
</button>
                <button type="button" class="btn btn-default btn-xs" title="Alumni" onclick="setrole('Alumni',<?=$row["rowid"]?>)">
  <span class="glyphicon glyphicon-user"></span> 
</button>
                <button type="button" class="btn btn-default btn-xs" title="Student" onclick="setrole('Student',<?=$row["rowid"]?>)">
  <span class="glyphicon glyphicon-thumbs-up"></span> 
</button>
                <button type="button"  class="btn btn-default btn-xs" title="Faculty" onclick="setrole('Faculty',<?=$row["rowid"]?>)">
  <span class="glyphicon glyphicon-asterisk" ></span> 
</button>
                <button type="button"  class="btn btn-default btn-xs" title="Delete" onclick="setrole('delete',<?=$row["rowid"]?>)">
  <span class="glyphicon glyphicon-remove" ></span> 
</button>
                </div>
            </td>
          </tr>  
                        <?}
    mysqli_close($con);
}
function updaterole($role,$id){
    $sql="update alumnireg set role='$role' where rowid=$id";
    if($role=="delete")
        $sql="delete from alumnireg where rowid=$id";
    require_once('dbConnection.php');

    $db = new dbConnection();
    $con = $db->getConnection();

    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
    mysqli_close($con);
    
}

function updateaccess($access,$id){
    $sql="update alumnireg set verified='$access' where rowid=$id";
    require_once('dbConnection.php');

    $db = new dbConnection();
    $con = $db->getConnection();

    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
    mysqli_close($con);
    
}