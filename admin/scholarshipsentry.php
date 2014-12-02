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

if($_POST["Scholarship"]!=NULL){
    $sql="update Scholarship set fundNote='$_REQUEST[Scholarship]' , studentlist='$_REQUEST[list]' , Testimonial='$_REQUEST[testimonial]'";
    require_once('../class/dbConnection.php');
        $db = new dbConnection();
        $con = $db->getConnection();
        //echo $sql;
        //Execute insert query
        $result = mysqli_query($con, $sql);

        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }

        mysqli_close($con);
    
}

    $sql="select * from Scholarship;";
    require_once('../class/dbConnection.php');
        $db = new dbConnection();
        $con = $db->getConnection();
        //echo $sql;
        //Execute insert query
        $result = mysqli_query($con, $sql);

        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
        if($row = mysqli_fetch_array($result)){
            $fundNote=$row["fundNote"];
            $studentlist=$row["studentlist"];
            $Testimonial=$row["Testimonial"];
        }
        mysqli_close($con);

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

                <? @include '../fragment/adminpane.php' ?>
                
                <div class="col-xs-12 col-sm-9">
                    <p class="pull-right visible-xs">
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
                    </p>
                    <form action="#" method="post">
                    <div class="panel panel-default" >
                        <div class="panel-body" >
                            <div class="media">
                                <h4>Scholarship fund Note</h4>
                               <div class="input-group">
  <span class="input-group-addon">Notes</span>
  <textarea class="form-control" placeholder="Scholarship" name="Scholarship" ><?=$fundNote?></textarea>
</div>
                            </div>
                        </div>
                    </div>

                     
                    <div class="panel panel-default" >
                        <div class="panel-body" >
                            <div class="media">
                                <h4>Benefited Student List </h4>
                               <div class="input-group">
  <span class="input-group-addon">Notes</span>
  <textarea class="form-control" placeholder="Student List " name="list"><?=$studentlist?></textarea>
</div>
                            </div>
                        </div>
                    </div>
                     <div class="panel panel-default" >
                        <div class="panel-body" >
                            <div class="media">
                                <h4>Testimonial from students</h4>
                               <div class="input-group">
  <span class="input-group-addon">Notes</span>
  <textarea class="form-control" placeholder="Testimonial" name="testimonial"><?=$Testimonial?></textarea>
</div>
                            </div>
                        </div>
                    </div>
                    <div><button class="btn btn-default" onclick="submit()">Update</button></div>
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
                        ShowAllStories("All");

                    });
                    var curFilter;
                    function ShowAllStories(filter) {
                        //alert("_ssnclick.php?action=viewstory&filter="+filter);
                        $.ajax({
                            url: "_ssnclick.php?action=viewstory&filter="+filter,
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
                            url: "_ssnclick.php?action=deletestory&id="+id,
                            type: "POST",
                            cache: false
                        })
                                .done(function(html) {
                            
                                ShowAllStories(curFilter);
                            
                        });
                    }
                    function addstory(msg) {
                        
                        var image=$("#filepic").val().split('\\').pop();
                        $.ajax({
                            url: "_ssnclick.php?action=insertstory&imagepath="+image+"&msg="+msg,
                            type: "POST",
                            cache: false
                        })
                                .done(function(html) {
                            
                                ShowAllStories(curFilter);
                            
                        });
                    }
        </script>
    </body>
</html>
