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

        <title> Activities</title>

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
                            <h4 class="media-heading">Your Message Here</h4>
                            <div class="input-group" style="margin-bottom: 10px">
                                <input type="text" class="form-control" id='txtmsg' placeholder="....My...Messgae....Here...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" onclick='sendmsg($("#txtmsg").val())'>send!</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                            <p id="content">Loading ...</p>
                       






                </div><!--/span-->


            </div><!--/row-->

            <!--hr-->

<?php
@include ("../fragment/footer.php");
?>


        </div><!--/.container-->



        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/offcanvas.js"></script>
        <script src="../js/holder.js"></script>
        <script>
            function sendmsg(msg) {
                
                    if($.trim(msg)==""){
                        $("#txtmsg").css("border-color","red")
                        setTimeout(function() { $('button[data-loading-text]').button("reset"); }, 100);
                        return;
                    }
                    $("#txtmsg").css("border-color","");

                    $.ajax({
                        url: "_chatter.php?action=insert&senderid=<?=$_REQUEST["refid"]?>&msg="+msg,
                        type: "POST",
                        cache: false
                    })
                            .done(function(html) {
                                $("#txtmsg").val();

                        ShowConvUser(<?=$_REQUEST["refid"]?>);

                    });
                }               
                function ShowConvUser(id) {

                    $.ajax({
                        url: "_chatter.php?action=getConv&user="+id,
                        type: "POST",
                        cache: false
                    })
                            .done(function(html) {

                        $("#content").html(html);

                    });
                }
                function DeleteChatter(id) {

                    $.ajax({
                        url: "_chatter.php?action=deleteconversation&id=" + id,
                        type: "POST",
                        cache: false
                    })
                            .done(function(html) {

                        ShowConvUser(<?=$_REQUEST["refid"]?>);

                    });
                }
                ShowConvUser(<?=$_REQUEST["refid"]?>);
        </script>
    </body>
</html>
