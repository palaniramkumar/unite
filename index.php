<?php
session_start();

/* if (extension_loaded("zlib") && (ini_get("output_handler") != "ob_gzhandler")) {
  ini_set("zlib.output_compression", 1);
  } */
$status = "true";
require_once('./class/dbConnection.php');
if ($_POST["uname"] != NULL || $_POST["uname"] != "") {
    $con = new dbConnection();
    $status = $con->validateUser($_POST["uname"], $_POST["upass"]);
}

require_once('./class/HealthCheck.php');
require_once('./class/CommonMethod.php');
require_once('./class/widget.php');
require_once('./class/poll.php');
if ($_SESSION["urole"] == "Pending")
    movePage("301", "./activity/newuserwizard.php");

if ($_REQUEST["msg"] == "invaliduser") {
    $status = "false";
}
//echo "<script>alert('$_SESSION[urole]')</script>";
 $sql="select * from Scholarship;";
    require_once('./class/dbConnection.php');
        $db = new dbConnection();
        $con = $db->getConnection();
        //echo $sql;
        //Execute insert query
        $result = mysqli_query($con, $sql);

        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
        if($row = mysqli_fetch_array($result)){
            $fundNote=$row["fundNote"];
            $studentlist=$row["studentlist"];
            $Testimonial=$row["Testimonial"];
        }
        
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="SSN Unite">
        <link rel="shortcut icon" href="./ico/favicon.png">

        <title>Official - SSN Alumni Portal</title>
        <style>
            .previewTextPosted,.previewDescriptionPosted, .previewUrlPosted{display:none}
            </style>
        <!-- Bootstrap core CSS -->
        <link href="./css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="./css/offcanvas.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="./js/html5shiv.js"></script>
          <script src="./js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <?php
        @include("./fragment/nav.php");
        ?>
        <div class="container">

		<!-- Carousel
             ================================================== -->
                        <div id="myCarousel" class="carousel slide">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img src="img/bg_img2.jpg" alt="First slide">
                                    <div class="container">
                                        <div class="carousel-caption">
                                            <h1>About SSN Unite</h1>
                                            <p>The SSN Alumni Association has been in existence since 2003 in a rather informal way. The institution has held Annual Alumni meetings on the 15th of August every year. These meetings have always been attended by a core group of Alumni members.</p>
                                            <p><a class="btn btn-large btn-primary" href="register.php">Sign up today</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <img src="img/bg_img4.jpg" alt="Second slide">
                                    <div class="container">
                                        <div class="carousel-caption">
                                            <h1>Tribute SSN</h1>
                                            <p>Tribute is the official alumni meet for SSN institutions. It started in 2010 with an enormous participation of more than 500 alumni all across the globe. This event is organized by the SSN Alumni Association with support from the college.</p>
                                            <p><a class="btn btn-large btn-primary" href="page.php?id=37">Learn more</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <img src="img/bg_img3.jpg" alt="Third slide">
                                    <div class="container">
                                        <div class="carousel-caption">
                                            <h1>Scholarship Day</h1>
                                            <p>The onset of the month of November had the SSNites buzzing as the D-day, the Scholarship Day, was due. The students hard work during the previous year was being rewarded at the Annual Scholarship Function</p>
                                            <p><a class="btn btn-large btn-primary" href="scholarships.php">About Scholarship</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div><!-- /.carousel -->


            <div class="row row-offcanvas row-offcanvas-right">
                <div class="col-xs-12 col-sm-9">
                    <p class="pull-right visible-xs">
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
                    </p>
                    <div >

                        



                    </div>


                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <?= homePagePost() ?>
                        </div>
                        <div class="col-sm-6 col-md-4">

                            <div class="list-group">
                                <a href="#" class="list-group-item active">
                                    <span class='glyphicon-icon fire'></span> Register for Upcoming events

                                </a>
                                <?= upcomingEvent() ?>



                            </div>
                            <div class="list-group">
                                <a href="#" class="list-group-item active"><span class='glyphicon glyphicon-paperclip'></span> Newsletters</a>
                                <a href="./uploads/Newsletter/SSN Unite Year Book 2014.pdf" class="list-group-item" target="_blank"><span class='glyphicon glyphicon-download'> </span> Year Book 2014</a>
                            </div>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><span class='glyphicon glyphicon-usd'></span> Scholarship Fund</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="list-group">
                                       <?=$fundNote?>
                                        <div><a href="scholarships.php">More...</a></div>
                                    </div>
                                </div>
                            </div>

                            <div class="list-group">
                                <a href="#" class="list-group-item active">
                                    <span class='glyphicon glyphicon-bullhorn'></span> Portal Updates

                                </a>
                                <?= getUpdates() ?>
                            </div>
                            <?
                            
                            $sql="SELECT company_name,detail,logo,url FROM entrepreneur_detail order by id desc limit 1";
        $result = mysqli_query($con, $sql);
        if (!$result) {
    echo "Error: %s\n", mysqli_error($con);
    exit();
}
        if($row = mysqli_fetch_array($result)){
            $name=$row["company_name"];
            $detail=$row["detail"];
            $url=$row["url"];
            $image=$row["logo"];
        }
        
        
        ?>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><span class='glyphicon glyphicon-briefcase'></span> Recently Added Startups</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="list-group">
                                        <div class="media">
                                            
                                            <?if($name!=null){?>
                                            <a class="pull-left" href="#">
                                             <?if(url_exists(getHost()."/uploads/logo/".strip_tags($row['logo']))){?>
                                    <img class="media-object" src="<?=  getHost()?>/class/timthumb.php?src=<?= getHost()?>/uploads/logo/<?=  strip_tags($row['logo'])?>&w=60" >
                                    <?}?>
                                            </a>
                                            <div class="media-body">
                                                
                                              <h4 class="media-heading"><?=$name?></h4>
                                              <?=substr($detail,0,128)?> <a href='entrepreneur.php'>(more...)</a>
                                              <a href='<?=$url?>' target="_blank" ><?=$url?></a>
                                               
                                            </div>
                                             <?}else{?>No Updates<?}?>
                                          </div>

                                    </div>
                                </div>
                            </div>
                                  
                            <?
                            
                            $sql="SELECT product_name,detail,logo,url FROM opensource_detail order by id desc limit 1";
        $result = mysqli_query($con, $sql);
        if (!$result) {
    echo "Error: %s\n", mysqli_error($con);
    exit();
}
        if($row = mysqli_fetch_array($result)){
            $name=$row["product_name"];
            $detail=$row["detail"];
            $url=$row["url"];
            $image=$row["logo"];
        }
        
        
        ?>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><span class='glyphicon glyphicon-briefcase'></span> Recently Added Opensource</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="list-group">
                                        <div class="media">
                                            
                                            <?if($name!=null){?>
                                            <a class="pull-left" href="#">
                                             <?if(url_exists(getHost()."/uploads/productlogo/".strip_tags($row['logo']))){?>
                                    <img class="media-object" src="<?=  getHost()?>/class/timthumb.php?src=<?= getHost()?>/uploads/productlogo/<?=  strip_tags($row['logo'])?>&w=60" >
                                    <?}?>
                                            </a>
                                            <div class="media-body">
                                                
                                              <h4 class="media-heading"><?=$name?></h4>
                                              <?=substr($detail,0,128)?> <a href='opensource.php'>(more...)</a>
                                              <a href='<?=$url?>' target="_blank" ><?=$url?></a>
                                               
                                            </div>
                                             <?}else{?>No Updates<?}?>
                                          </div>

                                    </div>
                                </div>
                            </div>
            
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <!--div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><span class='glyphicon glyphicon-facetime-video hot' style="color:green;"></span> Live Stream Event</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="list-group">
<a href="live.php"  class=" btn btn-google-plus btn-block">
                <span class="glyphicon glyphicon-facetime-video"></span>
                Watch Live Streaming

            </a>
                                    </div>
                                </div>
                            </div-->


<div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><span class='glyphicon glyphicon-picture'></span> SSN Gallery</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="list-group">
                                                    <div class="row" style="padding:10px;">
                                        <?php
							
                                            $folder = './uploads/Gallery/Tribute/';
                                            $filetype = '*.*';
                                            $files = glob($folder.$filetype);
                                            
                                            for ($i=0; $i<count($files); $i++) {
                                                $class="";
                                                if($i!=0){
                                                    $class="style='display:none'";
                                                }
                                                echo '<a '.$class.' data-toggle="lightbox" data-gallery="multiimages" name="'.$i.'" href="'.getHost().'/class/timthumb.php?h=600&src='.getHost().$files[$i].'"><img class="media-object" src="'.getHost().'/class/timthumb.php?src='.getHost().$files[$i].'&w=216" class="img-responsive"  /></a>';
                                                //echo substr($files[$i],strlen($folder),strpos($files[$i], '.')-strlen($folder));
                                               
                                            }
                                           
                                            ?>
						<a href="gallery.php">(More...)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

<?
                            
                            $sql="SELECT msg FROM Tweets where type='video' order by id desc limit 1";
        $result = mysqli_query($con, $sql);
       
        if($row = mysqli_fetch_array($result)){
            $msg=$row["msg"];
          
        }
        
        mysqli_close($con);
        ?>

                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><span class='glyphicon glyphicon-play'></span> Recent Video Added</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="list-group">
                                        <?=  html_entity_decode($msg)?>

                                    </div>
                                    <div><a href="video.php">More...</a></div>
                                </div>
                            </div>
                            <a class="twitter-timeline" data-dnt="true" href="https://twitter.com/TributeSSN" data-widget-id="405050954908569600">Tweets by @TributeSSN</a>
                            <script>!function(d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                                    if (!d.getElementById(id)) {
                                        js = d.createElement(s);
                                        js.id = id;
                                        js.src = p + "://platform.twitter.com/widgets.js";
                                        fjs.parentNode.insertBefore(js, fjs);
                                    }
                                }(document, "script", "twitter-wjs");</script>

                            <div class="list-group" id="fbupdate" >

                            </div>
                            
                        </div>
                    </div><!--/row-->
                </div><!--/span-->

                <?php
                @include './fragment/leftpane.php';
                ?>
            </div><!--/row-->

            <!--hr-->

            <?php
            @include ("./fragment/footer.php");
            ?>


        </div><!--/.container-->
        <!-- Modal -->
        <div class="modal" id="forgot">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Forgot UserName / Password ?</h4>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn" data-dismiss="modal">Close</a>
                        <a href="#" class="btn btn-primary">Send Email Verification</a>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="./js/jquery.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <script src="./js/offcanvas.js"></script>
        <script src="./js/holder.js"></script>
        <script src="./js/ekko-lightbox.js"></script>


    </body>
    <script>



    </script>
</html>
<script>
    $(document).ready(function()
    {
	setInterval(function(){$('.hot').toggle("slow")},1000);
	
        //Handles menu drop down
        $('.dropdown-menu').find('form').click(function(e) {
            e.stopPropagation();

        });

        $.ajax({
            url: "./class/fbAPI/fbcommunityupdate.php",
            type: "GET",
            cache: false
        })
                .done(function(html) {

                    $("#fbupdate").html(html);

                });
	    });
</script>

