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
    <meta name="author" content="SSN Unite">
    <link rel="shortcut icon" href="./ico/favicon.png">

    <title>SSN Video's</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/offcanvas.css" rel="stylesheet">
    <link href="./css/linkPreview.css" rel="stylesheet">


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
  <li class="active">Video</li>
</ol>
        
      <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <div class="row" style="padding-right: 10px;">
			<div class="panel panel-default" >
                        <div class="panel-body" >
                            <h4>SSN Videos</h4>
                        </div>
                    </div>
              <?
                    $sql="select id,msg,timestamp from Tweets where type='video' order by id desc";
                    //echo $sql;
                    require_once('./class/dbConnection.php');
                    $db = new dbConnection();
                    $con = $db->getConnection();
                    //echo $sql;
                    //Execute insert query
                    $result = mysqli_query($con, $sql);

                    if (!$result) {
                        die('Invalid query: ' . $sql);
                    }
                    
                    while ($row = mysqli_fetch_array($result)) {
                        ?> 
              
            
  
<?=htmlspecialchars_decode($row["msg"])?>
      
              <div class="previewPostedList"></div><?
                        
                    }
                    mysqli_close($con);
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
    <script>
    $(document).ready(function() {
        $('.linkPreview').linkPreview();
        // setting max number of images $('.linkPreview').linkPreview({imageQuantity: "put here the number"});
        // e.g. $('.linkPreview').linkPreview({imageQuantity: 15});
    });
</script>
  </body>
</html>
