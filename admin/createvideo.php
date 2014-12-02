<?php
require_once('../class/dbConnection.php');
require_once('../class/CommonMethod.php');
require_once('../class/widget.php');
require_once('../class/HealthCheck.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="../ico/favicon.png">

        <title> Upload Video</title>

        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../css/offcanvas.css" rel="stylesheet">

        <link rel="stylesheet" class="cssButtons" type="text/css" href="../css/linkPreview.css" />



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
                <li><a href="index.php">Home</a></li>
                <li class="active">Upload Video</li>
            </ol>

            <div class="row row-offcanvas row-offcanvas-right">

                <? @include '../fragment/adminpane.php' ?>

                <div class="col-xs-12 col-sm-9">
                    <p class="pull-right visible-xs">
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
                    </p>

                    <div class="panel panel-default" >
                        <div class="panel-body" >
                            <h4>Upload Your Video Here</h4>
                             <div id="previewLoading"></div>
                    <div style="float: left;">
                        <textarea type="text" id="text" style="text-align: left" placeholder="Paste Web URL Here (or) Type URL and Press [Space]"/>
                        </textarea>
                        <div style="clear: both"></div>
                    </div>
                    <div id="preview">
                        <div id="previewImages">
                            <div id="previewImage"><img src="img/loader.gif" style="margin-left: 43%; margin-top: 39%;" ></img>
                            </div>
                            <input type="hidden" id="photoNumber" value="0" />
                        </div>
                        <div id="previewContent">
                            <div id="closePreview" title="Remove" ></div>
                            <div id="previewTitle"></div>
                            <div id="previewUrl"></div>
                            <div id="previewDescription"></div>
                            <div id="hiddenDescription"></div>
                            <div id="previewButtons" >
                                <div id="previewPreviousImg" class="buttonLeftDeactive" ></div><div id="previewNextImg" class="buttonRightDeactive"  ></div>
                                <div class="photoNumbers" ></div>
                                <div class="chooseThumbnail">
                                    Choose a thumbnail
                                </div>
                            </div>
                            <input type="checkbox" id="noThumb" class="noThumbCb" />
                            <div class="nT"  >
                                <span id="noThumbDiv" >No thumbnail</span>
                            </div>
                        </div>
                        <div style="clear: both"></div>
                    </div>
                    <div style="clear: both"></div>
                    <div id="postPreview">
                        <input class="postPreviewButton" type="submit" value="Post" />
                        <div style="clear: both"></div>
                    </div>
                   
                    </div>
                    </div>
                    
                    <?
                    $sql="select id,msg,timestamp from Tweets where type='video' order by id desc";
                    //echo $sql;
                    require_once('../class/dbConnection.php');
                    $db = new dbConnection();
                    $con = $db->getConnection();
                    //echo $sql;
                    //Execute insert query
                    $result = mysqli_query($con, $sql);

                    if (!$result) {
                        die('Invalid query: ' . $sql);
                    }
                    
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                    
                    <div class="previewPostedList"><?=htmlspecialchars_decode($row["msg"])?></div><?
                        
                    }
                    mysqli_close($con);
                    ?>
                   
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

<script type="text/javascript" src="../js/linkPreview.js" ></script>

<script>
    $(document).ready(function() {
        $('.linkPreview').linkPreview();
        // setting max number of images $('.linkPreview').linkPreview({imageQuantity: "put here the number"});
        // e.g. $('.linkPreview').linkPreview({imageQuantity: 15});
    });
</script>

</body>
</html>
