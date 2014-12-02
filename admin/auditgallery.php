<?php

require_once('../class/dbConnection.php');
require_once('../class/CommonMethod.php');
require_once('../class/widget.php');
require_once('../class/HealthCheck.php');
$status = "true";
if ($_POST["uname"] != NULL) {
    $con = new dbConnection();
    $status = $con->validateUser($_POST["uname"], $_POST["upass"]);
}?>
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
                            <a class="navbar-brand"  id="heading">Audit Gallery </a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse navbar-ex1-collapse">

                            <ul class="nav navbar-nav navbar-right">
                            
                                <li><a href="#" ></a></li>
                                

                            </ul>

                        </div><!-- /.navbar-collapse -->
                    </nav>
                    <!--End of menu-->

                    
                    <!-- Extra small button group -->
                    <div class="btn-group" >
                        <button class="btn btn-default btn-xs dropdown-toggle" style="align:left"  type="button" data-toggle="dropdown" >
                            Filter<span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" >
                           
                            <li><a href="#" onclick="ShowAllStories('Student')">Students</a></li>
                            <li><a href="#" onclick="ShowAllStories('Alumni')">Alumni</a></li>
                            <li><a href="#" onclick="ShowAllStories('Admin')">Admin</a></li>
                            <li class="divider"></li>
                            
                            <li><a href="#" onclick="ShowAllStories('All')">All</a></li>
                        </ul></div>
         
                    <div class="row" id="content">
                        <div class="col-sm-6 col-md-3">
                          <div class="thumbnail panel">
                            <img data-src="holder.js/300x200" alt="...">
                            <div class="caption">  
                              <p>My story goes here</p>
                              <p><a href="#" class="btn btn-primary">Delete</a> <a href="#" class="btn btn-default">Share</a></p>
                            </div>
                          </div>
                        </div>

                      </div>
                </div><!--/span-->




                </div><!--/span-->





                    
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
$(document).ready(function()
                    {
                        ShowAllStories("All");

                    });
                    var curFilter;
                    function ShowAllStories(filter) {
                        //alert("_ssnclick.php?action=viewstory&filter="+filter);
                        $.ajax({
                            url: "../activity/_ssnclick.php?action=viewstory&filter="+filter,
                            type: "POST",
                            cache: false
                        })
                                .done(function(html) {
                            
                            $("#content").html(html);
                            
                        });
                        curFilter=filter;
                    }
                    function deleteStory(id) {
                        //alert("_ssnclick.php?action=deletestory&id="+id)
                        $.ajax({
                            url: "../activity/_ssnclick.php?action=deletestory&id="+id,
                            type: "POST",
                            cache: false
                        })
                                .done(function(html) {
                            
                                ShowAllStories(curFilter);
                            
                        });
                    }        </script>
    </body>
</html>
