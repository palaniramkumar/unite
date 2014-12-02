<?php
require_once('../class/HealthCheck.php');
require_once('../class/dbConnection.php');
require_once('../class/adminstatus.php');
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

        <!-- Custom styles for this template -->
        <link href="../css/offcanvas.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="../js/html5shiv.js"></script>
          <script src="../js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <? @include '../fragment/adminnav.php' ?>

        <div class="container">

            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Admin Dashboard</li>
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
                            <a class="navbar-brand"  id="heading">Dashboard</a>
                        </div>

                        
                    </nav>
                    <!--End of menu-->
                    
                    <div class="row" id="content">
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail panel" style="text-align: center">
                                <h3>Pending Users</h3>
                                <div class="caption">  
                                    <h1><?=getusercount("UNVERIFIED")?></h1>  
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail panel" style="text-align: center">
                                <h3>Feedback</h3>
                                <div class="caption">  
                                    <h1>N/A</h1>  
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail panel" style="text-align: center">
                                <h3>SPAMERS</h3>
                                <div class="caption">  
                                    <h1>N/A</h1>  
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail panel" style="text-align: center">
                                <h3>User Post</h3>
                                <div class="caption">  
                                    <h1><?=getusercount("POST")?></h1>  
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail panel" style="text-align: center">
                                <h3>User Photos</h3>
                                <div class="caption">  
                                    <h1><?=getusercount("STORY")?></h1>   
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail panel" style="text-align: center">
                                <h3>Registered Users</h3>
                                <div class="caption">  
                                    <h1><?=getusercount("VERIFIED")?></h1>  
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail panel" style="text-align: center">
                                <h3>Allow email</h3>
                                <div class="caption">  <h3>
                                    <div class="btn-group" data-toggle="buttons">
  <label class="btn btn-default">
    <input type="radio" name="options" onchange="adminstatus('alow_send_mail','0')" id="option1"> OFF 
  </label>
  <label class="btn btn-info">
      <input type="radio" name="options" onchange="adminstatus('alow_send_mail','1')"  id="option2"> ON
  </label>
 
                                    </div></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail panel" style="text-align: center">
                                <h3>Allow All Users</h3>
                                <div class="caption">  <h3>
                                    <div class="btn-group" data-toggle="buttons">
  <label class="btn btn-default">
    <input type="radio" name="options" onchange="adminstatus('alow_nonvalidate','0')" id="option3"> OFF 
  </label>
  <label class="btn btn-info">
    <input type="radio" name="options" onchange="adminstatus('alow_nonvalidate','1')" id="option4"> ON
  </label>
 
                                    </div></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                

            </div><!--/row-->

            <!--hr-->

            <div id="footer" >

                <div class="container">
                    <p class="text-muted credit"></p>
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
        <script>
            function adminstatus(field,value){
                
                $.ajax({
                            url: "_adminstatus.php?action=changeflag&field="+field+"&value="+value,
                            type: "POST",
                            cache: false
                        })
                                .done(function(html) {
                            
                                alert(html)
                        });
            }
            </script>
    </body>
</html>
