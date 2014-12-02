<?php
require_once('../class/HealthCheck.php');
require_once('../class/dbConnection.php');

validateUser("Admin");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="../ico/favicon.png">

        <title> Admin Dashboard</title>

        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/datepicker.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../css/offcanvas.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="../js/html5shiv.js"></script>
          <script src="../js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
         <? @include '../fragment/adminnav.php'?>

        <div class="container">

            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Admin Dashboard</a></li>
                <li class="active">Create Page</li>
            </ol>

            <div class="row row-offcanvas row-offcanvas-right">

                <? @include '../fragment/adminpane.php' ?>
                
                <div class="col-xs-12 col-sm-9">
                    <p class="pull-right visible-xs">
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
                    </p>


                    <!--Menu bar-->
                    <nav class="navbar navbar-default" role="navigation">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#" id="heading">Create Poll</a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse navbar-ex1-collapse">

                            <ul class="nav navbar-nav navbar-right">
                                 <li><a href="poll.php">+New</a></li>
                                <li><a href="#" onclick="ShowAllPoll()">Open</a></li>
                                <li id="save"><a href="#" onclick =savePoll()>Save</a></li>
                               

                            </ul>

                        </div><!-- /.navbar-collapse -->
                    </nav>
                    <!--End of menu-->






                    <div class="panel-body" >
                        <div class="col-md-10" id='content'>

                            <div class="well">
                                Poll Question <input type="text" class="input-sm" style="width: 100%" placeholder="Question"   id="q" >
                            </div>
                            <div class="well">
                                Choice 1 <input type="text" class="input-sm" style="width: 100%" placeholder="Choice 1"  id="c1" >

                            </div>
                            <div class="well">
                                Choice 2 <input type="text" class="input-sm" style="width: 100%" placeholder="Choice 2"  id="c2" >

                            </div>
                            <div class="well">
                                Choice 3 <input type="text" class="input-sm" style="width: 100%" placeholder="Choice 3"  id="c3" >

                            </div>
                            <div class="well">
                                Choice 4 <input type="text" class="input-sm" style="width: 100%" placeholder="Choice 4"  id="c4" >

                            </div>
                            <div class="well">
                                Choice 5 <input type="text" class="input-sm" style="width: 100%" placeholder="Choice 5"  id="c5" >

                            </div>
                            <div class="well">
                                Choice 6 <input type="text" class="input-sm" style="width: 100%" placeholder="Choice 6"  id="c6" >

                            </div>




                            <br/>

                            <div id="message"></div>

                        </div>


                    </div>





                </div><!--/end of right pane->
        
               
              </div><!--/row-->

                <!--hr-->

                <div id="footer" >

                    <div class="container">
                        <p class="text-muted credit">.</p>
                    </div>
                </div>
                <div id="footer" class="navbar navbar-default navbar-fixed-bottom" style="padding-top: 5px;">

                    <div class="container">
                        <p class="text-muted credit">SSN Alumni (c) 2013 | <a href="#">Privacy Policy</a> |  <a href="#">Credit</a>.</p>
                    </div>
                </div>


            </div><!--/.container-->



            <!-- Bootstrap core JavaScript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="../js/jquery.js"></script>
            <script src="../js/bootstrap.min.js"></script>
            <script src="../js/offcanvas.js"></script>
            <script src="../js/holder.js"></script>
            <script src="../js/bootstrap-datepicker.js"></script>
            <script src="../tinymce/tinymce.min.js"></script>

            <style>
                form { display: block; margin: 20px auto; background: #eee; border-radius: 10px; padding: 15px }
                #progress { position:relative; width:100%; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
                #bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
                #percent { position:absolute; display:inline-block; top:3px; left:48%; }
            </style>

            <script type="text/javascript">


            function savePoll() {
                var question = $("#q").val();
                var choice = $("#c1").val() + "#" + $("#c2").val() + "#" + $("#c3").val() + "#" + $("#c4").val() + "#" + $("#c5").val() + "#" + $("#c6").val() + "#";


                var param = "?action=insert&question=" + question + "&choice=" + choice;
                //alert("_poll.php" + param)
                $.ajax({
                    url: "_poll.php" + param,
                    type: "POST",
                    cache: false
                })
                        .done(function(html) {
                        ShowAllPoll();
                })


            }
            function ShowAllPoll() {
               
                $.ajax({
                    url: "_poll.php?action=getallpoll",
                    type: "POST",
                    cache: false
                })
                        .done(function(html) {

                    $("#content").html(html);
                    
                    $("#save").hide();

                });
            }
            function TogglePoll(id){
                $.ajax({
                    url: "_poll.php?action=toggle&id="+id,
                    type: "POST",
                    cache: false
                })
                        .done(function(html) {

                    ShowAllPoll();

                });
            }
            function DeletePoll(id){
                
                $.ajax({
                    url: "_poll.php?action=deletepoll&id="+id,
                    type: "POST",
                    cache: false
                })
                        .done(function(html) {

                    ShowAllPoll();

                });
            }
            </script>

    </body>
</html>
