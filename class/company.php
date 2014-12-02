<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

function insertCompanyProfile($name,$about,$image,$url){
        require_once('dbConnection.php');
        $db = new dbConnection();
        $con = $db->getConnection();
        $sql="insert into entrepreneur_detail (company_name,detail,url,logo,added_by,timestamp) values('$name','$about','$url','$image','$_SESSION[uid]',now())";
        $result = mysqli_query($con, $sql); //write the password validation
        
        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
        echo "inserted";
        mysqli_close($con);
    }
function deleteCompanyProfile($id){
        require_once('dbConnection.php');
        $db = new dbConnection();
        $con = $db->getConnection();
        $sql="delete from entrepreneur_detail where id=$id";
        $result = mysqli_query($con, $sql); //write the password validation
        
        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
        echo "Deleted";
        mysqli_close($con);
    }
function getCompanyProfile(){
        require_once('dbConnection.php');
        require_once('HealthCheck.php');
        require_once('CommonMethod.php');
        $db = new dbConnection();
        $con = $db->getConnection();
        $sql="select id,company_name,detail,url,logo from entrepreneur_detail ";
        $result = mysqli_query($con, $sql); //write the password validation
        
        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
         if (mysqli_num_rows($result) == 0) {
        ?>
         <div class="panel panel-default" >
                        <div class="panel-body" >
                            <div class="media">No Updates...</div>
                        </div>
         </div>
        <?
        mysqli_close($con);
        return;
    }
        while ($row = mysqli_fetch_array($result)) {
        ?>
            <div class="panel panel-default" >
                        <div class="panel-body" >
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <?if(url_exists(getHost()."/uploads/logo/".strip_tags($row['logo']))){?>
                                    <img class="media-object" src="<?=  getHost()?>/class/timthumb.php?src=<?= getHost()?>/uploads/logo/<?=  strip_tags($row['logo'])?>" >
                                    <?}?>
                                </a>
                                <div class="media-body">
                                  <h4 class="media-heading"><?=$row['company_name']?></h4>
                                  <h6><?=$row['detail']?></h6>
                                  <a href='<?=$row['url']?>' target="_blank"><?=$row['url']?></a>
                                </div>
					
                                <?=($_SESSION["urole"]=="Admin")?"<a href='#' onclick=deleteCompany('".$row['id']."')>Delete</a>":''?>
                              </div>
                            
                        </div>
                    </div>
            <?
        }
        mysqli_close($con);
    }
?>