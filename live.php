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
    <meta name="description" content="Watch Tribute '14 Live Event">
    <meta name="author" content="SSN Live Admin">
    <link rel="shortcut icon" href="./ico/favicon.png">

    <title>Tribute '14 Live Event</title>

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

<iframe src ="http://www.zeboba.com/ssnstream.php?id=ssnlive&width=420&height=260" width="900" height="600" frameborder='0'>  </iframe>
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
