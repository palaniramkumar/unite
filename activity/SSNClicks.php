<?php

require_once('../class/dbConnection.php');
require_once('../class/CommonMethod.php');
require_once('../class/widget.php');
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
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="featurette-image img-responsive" id="imgpreview" height="260px" width="260px" src="data:image/png;base64," data-src="holder.js/260x260/auto" alt="Generic placeholder image">
                                </a>
                                <div class="media-body visible-xs visible-sm visible-md visible-lg">
                                     <h4 class="media-heading">Step-1: Upload College Photo </h4>
                                    <form id="myForm" action="../class/upload.php" method="post" enctype="multipart/form-data">
                                        <p><input type="file"   size="60" name="myfile"  id="filepic"></p>
                                        <input type="hidden" value="college" name="imagetype"/>
                                        <p style="text-align: center"><input type="submit"  value="Upload"></p>

                                    </form>
                                    <div id="progress">
                                        <div id="bar"></div>
                                        <div id="percent">0%</div >
                                    </div>
                                 <div id="message"></div> 
                                 <br/>
                             
                                    <h4 class="media-heading">Step-2: Tell Your Story </h4>
                                    <div class="input-group" style="margin-bottom: 10px">
                                        <input type="text" class="form-control" id='storymsg' placeholder="....Your...Messgae....Here...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button" onclick='addstory($("#storymsg").val())'>Update!</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Extra small button group -->
                    <div class="btn-group" >
                        <button class="btn btn-default btn-xs dropdown-toggle" style="align:left"  type="button" data-toggle="dropdown" >
                            Filter<span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" >
                           
                            <li><a href="#" onclick="ShowAllStories('Student',0)">Students</a></li>
                            <li><a href="#" onclick="ShowAllStories('Alumni',0)">Alumni</a></li>
                            <li><a href="#" onclick="ShowAllStories('Admin',0)">Admin</a></li>
                            <li class="divider"></li>
                            <li><a href="#" onclick="ShowAllStories('Me',0)">Me</a></li>
                            <li><a href="#" onclick="ShowAllStories('All',0)">All</a></li>
                        </ul></div>
         
                    <div class="row" id="content">
                        

                      </div>
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
            var imagename="";
             function fileAjax(){
                        //alert ("<p>hello</p>".replace(/<(?:.|\n)*?>/gm, ''))
                        var options = {
                            beforeSend: function()
                            {
                                $("#progress").show();
                                //clear everything
                                $("#bar").width('0%');
                                $("#message").html("");
                                $("#percent").html("0%");
                            },
                            uploadProgress: function(event, position, total, percentComplete)
                            {
                                $("#bar").width(percentComplete + '%');
                                $("#percent").html(percentComplete + '%');

                            },
                            success: function()
                            {
                                $("#bar").width('100%');
                                $("#percent").html('100%');

                            },
                            complete: function(response)
                            {
                                $("#message").html("<font color='green'>" + response.responseText + "</font>");
                                $("#imgpreview").attr("src", "../uploads/college/"+response.responseText);
                                imagename=response.responseText;
                            },
                            error: function()
                            {
                                $("#message").html("<font color='red'> ERROR: unable to upload files</font>");

                            }

                        };

                        $("#myForm").ajaxForm(options);
                    }
                    $(document).ready(function()
                    {
                        fileAjax();
                        ShowAllStories("All",0);

                    });
                    var curFilter;
                    var curpage;
                    function ShowAllStories(filter,page) {
                        //alert("_ssnclick.php?action=viewstory&filter="+filter);
                        $.ajax({
                            url: "_ssnclick.php?action=viewstory&filter="+filter+"&page="+page,
                            type: "POST",
                            cache: false
                        })
                                .done(function(html) {
                            $(".next").hide();
                            $("#content").append(html);
                            
                        });
                        curFilter=filter;
                        curpage=page;
                    }
                    function deleteStory(id) {
                        //alert("_ssnclick.php?action=deletestory&id="+id)
                        $.ajax({
                            url: "_ssnclick.php?action=deletestory&id="+id,
                            type: "POST",
                            cache: false
                        })
                                .done(function(html) {
                            
                                ShowAllStories(curFilter,curpage);
                            
                        });
                    }
                    function addstory(msg) {
                        
                        var image=$("#filepic").val().split('\\').pop();
                        $.ajax({
                            url: "_ssnclick.php?action=insertstory&imagepath="+imagename+"&msg="+msg,
                            type: "POST",
                            cache: false
                        })
                                .done(function(html) {
                            
                                ShowAllStories(curFilter,curpage);
                            
                        });
                    }
        </script>
    </body>
</html>
