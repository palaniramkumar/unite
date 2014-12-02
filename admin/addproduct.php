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

        <title>OpenSource Products</title>

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
        @include("../fragment/adminpane.php");
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
                                     <h4 class="media-heading">Step-1: Upload Product Logo </h4>
                                    <form id="myForm" action="../class/upload.php" method="post" enctype="multipart/form-data">
                                        <p><input type="file"   size="60" name="myfile"  id="filepic"></p>
                                        <input type="hidden" value="productlogo" name="imagetype"/>
                                        <p style="text-align: center"><input type="submit"  value="Upload"></p>

                                    </form>
                                    <div id="progress">
                                        <div id="bar"></div>
                                        <div id="percent">0%</div >
                                    </div>
                                 <div id="message"></div> 
                                 <br/>
                             
                                    <h4 class="media-heading">Step-2: Product Detail </h4>
                                    <div class="input-group" style="margin-bottom: 10px">
                                        <input type="text" class="form-control" id='name' placeholder="Product Name">
                                        
                                        <input type="text" class="form-control" id='url' placeholder="Product URL">
                                        <textarea class="form-control" id='about' placeholder="About Product"></textarea>
                                        
                                    </div>
                                    <div class="input-group" style="margin-bottom: 10px">
                                    <span class="input-group-btn">
                                            <button class="btn btn-default" type="button" onclick='addProduct()'>Update!</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    
         
                    <div class="row" id="content" style="padding-left: 15px">
                        

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
                                $("#imgpreview").attr("src", "../uploads/productlogo/"+response.responseText);
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
                        getProduct();

                    });
                    function getProduct() {
                        //alert("_ssnclick.php?action=viewstory&filter="+filter);
                        $.ajax({
                            url: "_addopensource.php?action=getproduct",
                            type: "POST",
                            cache: false
                        })
                                .done(function(html) {
                            
                            $("#content").html(html);
                            
                        });
                   }
                    function deleteProduct(id) {
                        //alert("_addProduct.php?action=delete&id="+id)
                        $.ajax({
                            url: "_addopensource.php?action=delete&id="+id,
                            type: "POST",
                            cache: false
                        })
                                .done(function(html) {
                            
                                getProduct();
                            
                        });
                    }
                    function addProduct() {
                        
                        var image=$("#message").html();
                        var name=$("#name").val();
                        var url=$("#url").val();
                        var about=$("#about").val();
                        var url="_addopensource.php?action=addproduct&name="+name+"&url="+url+"&about="+about+"&image="+image;
                        //alert(url);
                        $.ajax({
                            url: url,
                            type: "POST",
                            cache: false
                        })
                                .done(function(html) {
                            
                                getProduct();
                            
                        });
                    }
        </script>
    </body>
</html>
