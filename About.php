<?php
require_once('./class/HealthCheck.php');
require_once('./class/dbConnection.php');
require_once('./class/CommonMethod.php');
require_once('./class/widget.php');
require_once('./class/poll.php');
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
    <meta name="description" content="">
    <meta name="author" content="Palani Ramkumar K">
    <link rel="shortcut icon" href="./ico/favicon.png">

    <title>SSN Unite - About Us</title>

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
  <li><a href="#">Home</a></li>
  <li class="active">About</li>
</ol>
        
      <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <div class="row">
            

      <div class="panel-body" >
        <div class="col-md-4" >
          <!---<img class="featurette-image img-responsive"  src="data:image/png;base64," data-src="holder.js/250x250/auto" alt="Generic placeholder image">--->
		  <img class="featurette-image img-responsive"  src="img/Unite.png" alt="SSN Unite">
        </div>
        <div class="col-md-7 well">
          <h2 class="featurette-heading" ><span class="text-muted">Welcome </span>to the SSN Alumni Network </h2>
          <p class="lead">SSN Alumni Association has great pleasure in welcoming you. We hope and wish that you would be the role models to the present and all future batches of SSN students. </p>
        </div>
      </div>
        
      </div>
<div class="panel panel-default">
     <div class="row">
          <div class="panel-body">
              <div class="col-md-7" style="font-size: 14px">
                  At SSN we believe in fostering a strong alumni network that not only helps former students remain connected but also provide an avenue for the philanthropic spirit of successful alumni. The Alumni Association will provide a platform for sharing your intellectual, cultural, career and professional experiences not just with the present students but also with other alumni. Our goal in the Alumni Office is to enable you to remain connected with SSN in order to promote stronger connections, and help provide opportunities for dialogue, sharing knowledge, voluntary service, social interaction and philanthropy           
         
              </div>
              <div class="col-md-4">
                  <div class="list-group">
  <a  class="list-group-item active">
    Our Hands
  </a>
  <a href="https://sites.google.com/a/ssnalumni.com/website/usa-chapter" class="list-group-item" target="_blank">USA Chapters</a>
  <a href="#" class="list-group-item">Chennai Chapter</a>
  <a href="#" class="list-group-item">SAR</a>

</div>
              </div>
          </div>
     </div>

</div>   </div><!--/span-->

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
	$(document).ready(function()
{
            
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

  </body>
</html>
