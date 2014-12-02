<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getAllGroup(){
    $sql="select id,value from categories where type='group'";
    require_once('dbConnection.php');

    $db = new dbConnection();
    $con = $db->getConnection();

    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
    
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>  
            <td><?=$row["value"]?></td>  
            
            <td><button type="button" class="btn btn-default btn-xs" onclick="editgroup(<?=$row["id"]?>)">
  <span class="glyphicon glyphicon-edit"></span> 
</button>
            <button type="button" class="btn btn-default btn-xs" onclick="deletegroup(<?=$row["id"]?>)">
  <span class="glyphicon glyphicon-remove"></span> 
</button>
            </td>
          </tr>  
                        <?}
    mysqli_close($con);
    
}

function getGrouplinks(){
    $sql="select id,value,description from categories where type='group'";
    require_once('dbConnection.php');

    $db = new dbConnection();
    $con = $db->getConnection();

    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
    
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <a class="list-group-item" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="<?=$row["description"]?>" data-original-title="" title="" href="collaborate.php?type=group&id=<?=$row["id"]?>"><?=$row["value"]?><span class="badge"></span></a>
            
                        <?}
    mysqli_close($con);
}
function updateGroup($id,$groupname){
    $sql="update categories set value='$groupname' where id=$id";
    require_once('dbConnection.php');

    $db = new dbConnection();
    $con = $db->getConnection();

    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
    mysqli_close($con);
    
}
function deleteGroup($id){
    $sql="delete from categories  where id=$id";
    require_once('dbConnection.php');

    $db = new dbConnection();
    $con = $db->getConnection();

    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
    mysqli_close($con);
    
}
function addGroup($groupname,$about){
    $sql="insert into categories (value,type,description) values ('$groupname','group','$about')";
    require_once('dbConnection.php');

    $db = new dbConnection();
    $con = $db->getConnection();

    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
    mysqli_close($con);
    
}