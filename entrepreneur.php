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
    <meta name="description" content="">
    <meta name="author" content="SSN Unite">
    <link rel="shortcut icon" href="./ico/favicon.png">

    <title>Start UP'S</title>

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
  <li class="active">Start Ups</li>
</ol>
        
      <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <div class="row" style="padding-right: 10px;" id="content">
			<?=getCompanyProfile()?>
              
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
    <script>
   function deleteCompany(id) {
                      
                        $.ajax({
                            url: "./admin/_addcompany.php?action=delete&id="+id,
                            type: "POST",
                            cache: false
                        })
                                .done(function(html) {
                            
                                getcompany();
                            
                        });
                    }
                     function getcompany() {
                        //alert("_ssnclick.php?action=viewstory&filter="+filter);
                        $.ajax({
                            url: "./admin/_addcompany.php?action=getcompany",
                            type: "POST",
                            cache: false
                        })
                                .done(function(html) {
                            
                            $("#content").html(html);
                            
                        });
                   }
</script>
  </body>
</html>
