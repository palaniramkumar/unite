<?php
require_once('./class/HealthCheck.php');
require_once('./class/dbConnection.php');
require_once('./class/CommonMethod.php');
require_once('./class/widget.php');
require_once('./class/poll.php');
require_once('./class/company.php');
$status="true";
if($_POST["uname"]!=NULL){
    $con= new dbConnection();
    $status=  $con->validateUser($_POST["uname"], $_POST["upass"]) ;
    
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Lastest Potoshoots taken in SSN Campus or an Event Gallery ">
    <meta name="author" content="SSN Unite">
    <link rel="shortcut icon" href="./ico/favicon.png">

    <title>Gallery</title>

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

      <ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li class="active">Gallery</li>
</ol>
        
      <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
<?
ini_set('display_errors', 1);

// Enable error reporting for NOTICES
error_reporting(E_ALL );
function listFolderFiles($dir){

$results = scandir($dir);

foreach ($results as $result) {
    if ($result === '.' or $result === '..') continue;

    if (is_dir($dir. '/' . $result)) {
        ?>
 <div class="col-sm-6 col-md-4" align="center" >
    <div class="thumbnail" style="background-color:white;padding-top:10px;">
	<?
$folder = $dir. '/' . $result.'/';

                                            $filetype = '*.*';
                                            $files = glob($folder.$filetype);
                                            
                                            for ($i=0; $i<count($files); $i++) {
                                                $class="";
                                                if($i!=0){
                                                    $class="style='display:none'";
                                                }
                                                echo '<a '.$class.' data-toggle="lightbox" data-gallery="multiimages" name="'.$i.'" href="'.getHost().'/class/timthumb.php?h=600&src='.getHost().$files[$i].'"><img height="128px" class="media-object" src="'.getHost().'/class/timthumb.php?src='.getHost().$files[$i].'&w=216" class="img-responsive"  /></a>';
                                                //echo substr($files[$i],strlen($folder),strpos($files[$i], '.')-strlen($folder));
                                               
                                            }
             ?>                              
                                        
       <div class="caption">
        <h3><?=$result?></h3>
      </div>
    </div>
  </div>
	
<?    }
}
	
 
}
?>

          <div class="row" style="padding-right: 10px;" id="content">
<?
listFolderFiles('./uploads/Gallery');
?>

              
      </div>
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



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./js/jquery.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/offcanvas.js"></script>
    <script src="./js/holder.js"></script>
        <script src="./js/ekko-lightbox.js"></script>
  </body>
</html>
