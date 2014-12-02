<?php
require_once('../class/Post.php');
require_once('../class/dbConnection.php');
require_once '../class/HealthCheck.php';
require_once('../class/widget.php');
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
         <? @include '../fragment/nav.php'?>

        <div class="container">

            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Activity</a></li>
                <li class="active">Create Page</li>
            </ol>

            <div class="row row-offcanvas row-offcanvas-right">

                <?php 
        @include("../fragment/activitypane.php");
    ?>
                <div class="col-xs-12 col-sm-9" >
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
                            <a class="navbar-brand" href="#" id="heading">New Page</a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse navbar-ex1-collapse">

                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="#" onclick="ShowAllPost()">Open</a></li>
                                <li><a href="#" onclick =savePost()>Save</a></li>
                                <li><a href="#">Cancel</a></li>

                            </ul>

                        </div><!-- /.navbar-collapse -->
                    </nav>
                    <!--End of menu-->

                    <div id="content">

                    <div class="row" >


                        <div class="panel-body" >
                            <div class="col-md-4" >
                                <img style="margin: auto" id="imgpreview" class="featurette-image img-responsive"  src="data:image/png;base64," data-src="holder.js/250x250/auto" alt="Generic placeholder image">

                                <form id="myForm" action="../class/upload.php" method="post" enctype="multipart/form-data">
                                    <p><input type="file"   size="60" name="myfile"  id="filepic"></p>
                                    <input type="hidden" value="post" name="imagetype"/>
                                    <p style="text-align: center"><input type="submit"  value="Upload"></p>
                                 
                                </form>
                                

                                <br/>

                                

                            </div>
                            <div class="col-md-7 well">
                                <h2 class="featurette-heading editable" id='pHead'>Tribute SSN  <span class="text-muted">'13</span></h2>
                                <p class="lead editable" id="pSum">Tribute is the official alumni
                                    meet for SSN institutions. It
                                    started in 2010 with an
                                    enormous participation of more
                                    than 500 alumni all across the
                                    globe. This event is organized by
                                    the SSN Alumni Association with
                                    support from the college.</p>
                                <p class="editable panel" id="pTag">Tag value</p>
                                <div id="progress">
                                        <div id="bar"></div>
                                        <div id="percent">0%</div >
                                    </div>
                                 <div id="message"></div>
                            </div>
                            
                        </div>
                       
                    </div>
                    <div class="panel panel-default editable">
                        <div class="panel-body" id="pDesc">The SSN Alumni Association has been in existence since 2003 in a rather informal way. The
                            institution has held Annual Alumni meetings on the 15th of August every year. These
                            meetings have always been attended by a core group of Alumni members. The emphasis
                            was more on providing an opportunity for the Alumni to connect with the campus and
                            faculty and be abreast of developments in the Institution. There were some activities by
                            the Alumni in terms of organizing guest lectures, conducting training programs for
                            students in soft skills and facing interviews and providing inputs for projects. Office
                            bearers were elected every year and they carried the baton till the next year.</div>
                    </div>
                        <input type='hidden' value="insert" id='type'/>
                        <input type='hidden' value="0" id='postid'/>
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
            <script src="../tinymce/tinymce.min.js"></script>
            <script src="../js/jquery.form.min.js"></script>
            <style>
                form { display: block; margin: 20px auto; background: #eee; border-radius: 10px; padding: 15px }
                #progress { position:relative; width:100%; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
                #bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
                #percent { position:absolute; display:inline-block; top:3px; left:48%; }
            </style>

            <script type="text/javascript">
                var imagename="";
                    function loadEditor(){
                        tinymce.init({
                        selector: "h2.editable",
                        inline: true,
                        toolbar: "undo redo",
                        menubar: false
                    });
                    tinymce.init({
                        selector: "p.editable",
                        inline: true,
                        toolbar: "undo redo",
                        menubar: false
                    });
                    tinymce.init({
                        selector: "div.editable",
                        inline: true,
                        plugins: [
                            "advlist autolink lists link image charmap print preview anchor",
                            "searchreplace visualblocks code fullscreen",
                            "insertdatetime media table contextmenu paste"
                        ],
                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                    });
                    }
                    loadEditor();
        //jquery upload
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
                                $("#imgpreview").attr("src", "../uploads/post/"+response.responseText);
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

                    });

                    function savePost() {
                    
                        var title = $("#pHead").html();
                        var summary = $("#pSum").html();
                        var desc = $("#pDesc").html();
                        var tag = $("#pTag").html().replace(/<(?:.|\n)*?>/gm, '');
                        var image =  imagename;
                        if(image=="")
                            image =  $("#filepichidden").val();
                        //alert(image)
                        //return;
                        var type = $("#type").val();
                        var id=$("#postid").val();
                        var param = "?action="+type+"&title=" + title + "&summary=" + summary + "&desc=" + desc + "&tags=" + tag + "&image=" + image+"&id="+id;
                        alert("../admin/_post.php" + param)
                        
                        $.ajax({
                            url: "../admin/_post.php" + param,
                            type: "POST",
                            cache: false
                        })
                                .done(function(html) {
                            ShowAllPost();
                        })


                    }
                    function ShowAllPost() {
                        
                        $.ajax({
                            url: "../admin/_post.php?action=getallpost",
                            type: "POST",
                            cache: false
                        })
                                .done(function(html) {
                            
                            $("#content").html(html);
                            
                        });
                    }
                    function DeletePost(id) {
                       
                        $.ajax({
                            url: "../admin/_post.php?action=deletepost&id="+id,
                            type: "POST",
                            cache: false
                        })
                                .done(function(html) {
                            
                           ShowAllPost();
                            
                        });
                    }
                    function TogglePost(id) {
                       
                        $.ajax({
                            url: "../admin/_post.php?action=togglepost&id="+id,
                            type: "POST",
                            cache: false
                        })
                                .done(function(html) {
                            
                           ShowAllPost();
                            
                        });
                    }
                    function EditPost(id) {
                       
                        $.ajax({
                            url: "../admin/_post.php?action=editpost&id="+id,
                            type: "POST",
                            cache: false
                        })
                                .done(function(html) {
                            
                           $("#content").html(html);
                           loadEditor();
                            fileAjax();
                        });
                    }
                  
            </script>

    </body>
</html>
