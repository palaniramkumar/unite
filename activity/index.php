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
      <img class="media-object" height="64" src="<?=getProfilePic($_SESSION[uid])?>"  alt="Generic placeholder image">
  </a>
  <div class="media-body">
    <h4 class="media-heading">What to share ?</h4>
    <div class="input-group" style="margin-bottom: 10px">
        <input type="text" class="form-control" id='tweetmsg' placeholder="....My...Messgae....Here...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" onclick='addtweet($("#tweetmsg").val())'>Update!</button>
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
      <li><a href="#" onclick="loadtweet('All',0)">All</a></li>
    <li><a href="#" onclick="loadtweet('Alumni',0)">Alumni</a></li>
    <li><a href="#"onclick="loadtweet('Student',0)">Students</a></li>
    
    <li class="divider"></li>
    <li><a href="#" onclick="loadtweet('Admin',0)">Admin</a></li>
    <li><a href="#" onclick="loadtweet('Me',0)">Me</a></li>
  </ul></div>
          
             
              
              <ul class="media-list" id='feeditem'>
                  <div class="loadmore">
                  Please Wait... We are getting latest feeds...
                  </div>
</ul>
              
              
          
          
        
       
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
        function addtweet(msg){
            //alert("_Activity.php?action=addtweet&msg="+msg);
           
            if($.trim(msg)==""){
                $("#tweetmsg").css("border-color","red")
                setTimeout(function() { $('button[data-loading-text]').button("reset"); }, 100);
                return;
            }
            $("#tweetmsg").css("border-color","");
            $.ajax({
                    url: "_Activity.php?action=addtweet&msg="+msg,
                    type: "POST",
                    cache: false
                })
                        .done(function(html) {
                    $("#tweetmsg").val("");
                    $("#feeditem").prepend(html)

                });
        }
        function tweetcomment(tweetid){
            msg=$("#comment"+tweetid).val();
            if($.trim(msg)==""){
                $("#comment"+tweetid).css("border-color","red")
                setTimeout(function() { $('button[data-loading-text]').button("reset"); }, 100);
                return;
            }
            $("#comment"+tweetid).css("border-color","");
            //alert("_Activity.php?action=commenttweet&msg="+msg+"&tweetid="+tweetid);
            //return;
            $.ajax({
                    url: "_Activity.php?action=commenttweet&msg="+msg+"&tweetid="+tweetid,
                    type: "POST",
                    cache: false
                })
                        .done(function(html) {
                    $("#comment"+tweetid).val("");
                    $("#nested"+tweetid).append(html)

                });
        }
        function loadtweet(filter,page){
            
            //alert("_Activity.php?action=loadtweet");
            $.ajax({
                    url: "_Activity.php?action=loadtweet&filter="+filter+"&page="+page,
                    type: "POST",
                    cache: false
                })
                        .done(function(html) {
                    $(".loadmore").hide();
                    $("#feeditem").append(html)

                });
        }
        function deletetweet(id){
            
            //alert("_Activity.php?action=deletetweet&id="+id);
            $.ajax({
                    url: "_Activity.php?action=deletetweet&id="+id,
                    type: "POST",
                    cache: false
                })
                        .done(function(html) {
                    //alert(html)
                    $("#tweet"+id).hide();

                });
        }
        function deletecomment(id){
            
            //alert("_Activity.php?action=deletecomment&id="+id);
            $.ajax({
                    url: "_Activity.php?action=deletecomment&id="+id,
                    type: "POST",
                    cache: false
                })
                        .done(function(html) {
                    
                    $("#comment"+id).hide();

                });
        }
        loadtweet("all",0);
    </script>
  </body>
</html>
