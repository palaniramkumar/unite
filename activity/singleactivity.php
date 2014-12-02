<?php
session_start();

require_once('../class/dbConnection.php');
require_once('../class/CommonMethod.php');
require_once('../class/widget.php');
require_once('../class/StringTokenizer.php');
require_once('../class/HealthCheck.php');
$status = "true";
if ($_POST["uname"] != NULL) {
    $con = new dbConnection();
    $status = $con->validateUser($_POST["uname"], $_POST["upass"]);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="../ico/favicon.png">

        <title> Activity</title>

        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../css/offcanvas.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="../js/html5shiv.js"></script>
          <script src="../js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <?php
        @include("../fragment/nav.php");
        ?>

        <div class="container">

            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Activity</li>
            </ol>

            <div class="row row-offcanvas row-offcanvas-right">


                <?php
                @include("../fragment/activitypane.php");
                ?>

                <div class="col-xs-12 col-sm-9">
                    <p class="pull-right visible-xs">
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
                    </p>




                    <div class="panel panel-default" >
                        <div class="panel-body" >
                            <h4 class="media-heading">Tweet #<?=$_REQUEST["id"]?></h4>
                            <ul class="media-list" id="feeditem">
                                Loading...
                            </ul>
                        </div>
                    </div>

                    




                </div><!--/span-->


            </div><!--/row-->

            <!--hr-->

            <?php
            @include ("../fragment/footer.php");
            ?>


        </div><!--/.container-->


        <style>
                form { display: block; margin: 20px auto; background: #eee; border-radius: 10px; padding: 15px }
                #progress { position:relative; width:100%; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
                #bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
                #percent { position:absolute; display:inline-block; top:3px; left:48%; }
        </style>
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/offcanvas.js"></script>
        <script src="../js/holder.js"></script>
        <script src="../js/jquery.form.min.js"></script>
        <script>
        function tweetcomment(tweetid){
            msg=$("#comment"+tweetid).val();
            //alert("_Activity.php?action=commenttweet&msg="+msg+"&tweetid="+tweetid);
            //return;
            $.ajax({
                    url: "_Activity.php?action=commenttweet&msg="+msg+"&tweetid="+tweetid,
                    type: "POST",
                    cache: false
                })
                        .done(function(html) {
                    //alert(html)
                    $("#nested"+tweetid).append(html)

                });
        }
        function loadtweet(id){
            
            //alert("_Activity.php?action=loadtweet");
            $.ajax({
                    url: "_Activity.php?action=loadsingletweet&id="+id,
                    type: "POST",
                    cache: false
                })
                        .done(function(html) {
                    //alert(html)
                    $("#feeditem").html(html)

                });
        }
        function deletetweet(id){
            
            //alert("_Activity.php?action=deletetweet&id="+id);
            $.ajax({
                    url: "_Activity.php?action=deletetweet&id="+id,
                    type: "POST",
                    cache: false
                })
                        .done(function(html) {
                    //alert(html)
                    $("#tweet"+id).hide();

                });
        }
        function deletecomment(id){
            
            //alert("_Activity.php?action=deletecomment&id="+id);
            $.ajax({
                    url: "_Activity.php?action=deletecomment&id="+id,
                    type: "POST",
                    cache: false
                })
                        .done(function(html) {
                    
                    $("#comment"+id).hide();

                });
        }
        loadtweet(<?=$_REQUEST["id"]?>);
        </script>
    </body>
</html>
