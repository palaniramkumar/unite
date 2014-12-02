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
                            <a class="navbar-brand"  id="heading">Group Detail </a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse navbar-ex1-collapse">

                            <ul class="nav navbar-nav navbar-right">
                            
                                <li><a href="#" ></a></li>
                                

                            </ul>

                        </div><!-- /.navbar-collapse -->
                    </nav>
                    <!--End of menu-->

                    <div class="panel-body">
              <div class="input-group">
                   <span class="input-group-addon"> Group Name </span>
                  <input type="text" id="groupname"  placeholder="Unite Discussions" class="form-control">
              </div>
                  <div class="input-group">
                      <span class="input-group-addon">Group Detail</span>
                  <textarea id="aboutgroup" placeholder="About Discussions"  class="form-control"></textarea>
                   
                  </div>
                  <div class="input-group">
     <span class="input-group-btn" >
        <button class="btn btn-default" type="button" onclick="addGroup($('#groupname').val())">Add</button>
      </span>
    </div>
            </div>
          
       
                    <form action="#" method="post">
                    <div class="panel panel-default" >
                        <div class="panel-body" >
                            <div class="media">
                                <table class="table table-striped">  
        <thead>  
          <tr>  
            <th>Group Name</th>  
            <th>Action</th>  
          </tr>  
        </thead>  
        <tbody id="content">  
            <TR><TD>LOADING...</TD></TR>
        </tbody>  
      </table> 

                            </div>
                        </div>
                    </div>

                     
                    </form>
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
                    function ShowAllusers() {
                        //alert("_ssnclick.php?action=viewstory&filter="+filter);
                        
                        $.ajax({
                            url: "_addgroup.php?action=getallgroups",
                            type: "POST",
                            cache: false
                        })
                                .done(function(html) {
                           
                            $("#content").html(html);
                            
                        });
                    }
                    ShowAllusers();
                    function deletegroup(id) {
                        //alert("_ssnclick.php?action=viewstory&filter="+filter);
                       
                        $.ajax({
                            url: "_addgroup.php?action=delete&id="+id,
                            type: "POST",
                            cache: false
                        })
                                .done(function(html) {
                            
                            ShowAllusers();
                            
                        });
                    }
                    function updategroup(id,groupname) {
                        //alert("_ssnclick.php?action=viewstory&filter="+filter);
                       
                        $.ajax({
                            url: "_addgroup.php?action=update&groupname="+groupname+"&id="+id,
                            type: "POST",
                            cache: false
                        })
                                .done(function(html) {
                            
                            ShowAllusers();
                            
                        });
                    }
                    function addGroup(groupname) {
                        //alert("_ssnclick.php?action=viewstory&filter="+filter);
                       var about=$('#aboutgroup').val();
                        $.ajax({
                            url: "_addgroup.php?action=add&groupname="+groupname+"&about="+about,
                            type: "POST",
                            cache: false
                        })
                                .done(function(html) {
                            
                            ShowAllusers();
                            
                        });
                    }
        </script>
    </body>
</html>
